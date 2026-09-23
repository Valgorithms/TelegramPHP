<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram;

use Evenement\EventEmitterInterface;
use Evenement\EventEmitterTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;

use function React\Promise\resolve;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Telegram\Api\Methods;
use Telegram\Events\Event;
use Telegram\Factory\Factory;
use Telegram\Http\DriverInterface;
use Telegram\Http\Drivers\React as ReactDriver;
use Telegram\Http\Http;
use Telegram\Http\HttpInterface;
use Telegram\Http\LocalFiles;
use Telegram\Parts\File;
use Telegram\Parts\Part;
use Telegram\Parts\Update;
use Telegram\Parts\User;
use Telegram\Polling\Poller;
use Telegram\Repository\AbstractRepository;
use Telegram\Repository\ChatRepository;
use Telegram\Repository\UserRepository;
use Telegram\Webhook\Server;

/**
 * The Telegram client - the role `Discord\Discord` plays under DiscordPHP.
 *
 * Owns the {@see Http} transport, the {@see Factory}, the caches
 * (`$telegram->chats`, `$telegram->users`), and the update source: long polling
 * by default, or a webhook listener when one is configured. Every Bot API method
 * is a real method on this class, pulled in from the generated {@see Methods}
 * trait, so calls read exactly as the documentation does:
 *
 * ```php
 * $telegram = new Telegram(['token' => getenv('TELEGRAM_TOKEN')]);
 *
 * $telegram->on(Event::MESSAGE, function (Message $message) use ($telegram) {
 *     $telegram->sendMessage($message->chat->id, 'pong');
 * });
 *
 * $telegram->run();
 * ```
 *
 * Updates arrive as parts and are emitted twice: once as {@see Event::UPDATE}
 * with the whole {@see Update}, and once under the update's own type
 * ({@see Event::MESSAGE}, {@see Event::CALLBACK_QUERY}, ...) with just that
 * payload, which is what most handlers want.
 *
 * @property-read ChatRepository $chats The chats this client has seen or fetched.
 * @property-read UserRepository $users The users this client has seen.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class Telegram implements EventEmitterInterface
{
    use EventEmitterTrait;
    use Methods;

    public const VERSION = '1.0.0';

    /** The Bot API version the bundled spec was generated from. */
    public const BOT_API_VERSION = '10.3';

    /** Repository accessors: property name => class. */
    private const REPOSITORIES = [
        'chats' => ChatRepository::class,
        'users' => UserRepository::class,
    ];

    /** @var array<string, mixed> */
    protected array $options;

    protected LoopInterface $loop;

    protected LoggerInterface $logger;

    protected HttpInterface $http;

    /** Where a local Bot API server's files are, as this process sees them. */
    protected LocalFiles $localFiles;

    protected Factory $factory;

    protected ?Poller $poller = null;

    protected ?Server $webhook = null;

    /** The bot's own account, once `getMe` has answered. */
    protected ?User $botUser = null;

    protected bool $ready = false;

    /** @var array<string, AbstractRepository> */
    private array $repositories = [];

    /**
     * @param array<string, mixed> $options
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface When the options are wrong.
     */
    public function __construct(array $options = [])
    {
        $this->options = $this->resolveOptions($options);

        $this->loop = $this->options['loop'];
        $this->logger = $this->options['logger'];
        $this->factory = new Factory($this);

        $this->http = $this->options['http'] ?? new Http(
            $this->options['token'],
            $this->loop,
            $this->logger,
            $this->options['driver'] ?? new ReactDriver($this->loop, $this->options['socket_options']),
            $this->options['base_url'],
        );

        $this->localFiles = new LocalFiles($this->options['local_files'], $this->loop);
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     */
    protected function resolveOptions(array $options): array
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        return $resolver->resolve($options);
    }

    /**
     * Declares the options this client accepts. Subclasses add their own by
     * calling `parent::configureOptions($resolver)` first - see
     * {@see \Telegram\CommandClient\TelegramCommandClient}.
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefined(['http', 'driver', 'webhook'])
            ->setDefaults([
                'loop' => static fn (Options $options): LoopInterface => Loop::get(),
                'logger' => static fn (Options $options): LoggerInterface => new NullLogger(),
                'base_url' => Http::BASE_URL,
                'socket_options' => [],
                'poll_timeout' => 50,
                'poll_limit' => 100,
                'allowed_updates' => null,
                'drop_pending_updates' => false,
                'local_files' => [],
            ])
            ->setRequired('token')
            ->setAllowedTypes('token', 'string')
            ->setAllowedTypes('loop', LoopInterface::class)
            ->setAllowedTypes('logger', LoggerInterface::class)
            ->setAllowedTypes('http', HttpInterface::class)
            ->setAllowedTypes('driver', DriverInterface::class)
            ->setAllowedTypes('base_url', 'string')
            ->setAllowedTypes('socket_options', 'array')
            ->setAllowedTypes('poll_timeout', 'int')
            ->setAllowedTypes('poll_limit', 'int')
            ->setAllowedTypes('allowed_updates', ['null', 'string[]'])
            ->setAllowedTypes('drop_pending_updates', 'bool')
            ->setAllowedTypes('local_files', 'string[]')
            ->setAllowedTypes('webhook', ['null', 'array']);
    }

    // -- Running ------------------------------------------------------------

    /**
     * Identifies the bot, starts receiving updates, and runs the event loop.
     *
     * Pass `false` to keep the loop under your own control - useful when the bot
     * shares a loop with other ReactPHP services.
     */
    public function run(bool $runLoop = true): void
    {
        $this->start();

        if ($runLoop) {
            $this->loop->run();
        }
    }

    /**
     * Identifies the bot and starts receiving updates, without running the loop.
     *
     * @return PromiseInterface<User> The bot's own account.
     */
    public function start(): PromiseInterface
    {
        return $this->getMe()->then(function (User $me): User {
            $this->botUser = $me;
            $this->ready = true;
            $this->logger->info('Logged in as @' . $me->username . ' (' . $me->id . ')');

            isset($this->options['webhook']) ? $this->startWebhook() : $this->startPolling();

            $this->emit(Event::READY, [$this]);

            return $me;
        }, function (\Throwable $e): void {
            $this->emit(Event::ERROR, [$e, $this]);

            throw $e;
        });
    }

    /** Stops receiving updates. The loop keeps running unless you stop it too. */
    public function stop(): void
    {
        $this->poller?->stop();
        $this->webhook?->close();
        $this->poller = null;
        $this->webhook = null;
        $this->ready = false;
    }

    /**
     * Stops receiving updates and stops the event loop.
     *
     * Named `shutdown` rather than `close` because `close` is a Bot API method of
     * its own - it releases the bot from Telegram's server before moving it to a
     * local one - and the generated method for it must keep that name.
     */
    public function shutdown(): void
    {
        $this->stop();
        $this->loop->stop();
    }

    protected function startPolling(): void
    {
        $this->poller = new Poller(
            $this,
            $this->options['poll_timeout'],
            $this->options['poll_limit'],
            $this->options['allowed_updates'],
            $this->options['drop_pending_updates'],
        );

        $this->poller->start();
    }

    protected function startWebhook(): void
    {
        $this->webhook = new Server($this, $this->options['webhook']);
        $this->webhook->listen();
    }

    // -- Updates ------------------------------------------------------------

    /**
     * Turns one raw update into parts and emits it - as {@see Event::UPDATE} with
     * the whole {@see Update}, then under its own type with just that payload.
     *
     * Both the poller and the webhook listener funnel through here, so a handler
     * never has to care which one is in use.
     *
     * @param Update|array<string, mixed> $raw A hydrated update, or the payload
     *                                         a webhook delivery arrived as.
     */
    public function handleUpdate(Update|array $raw): Update
    {
        /** @var Update $update */
        $update = $raw instanceof Update ? $raw : $this->factory->part(Update::class, $raw);

        $this->emit(Event::UPDATE, [$update, $this]);

        foreach (Event::PAYLOAD_TYPES as $type => $_) {
            $payload = $update->{$type};

            if ($payload === null) {
                continue;
            }

            $this->cachePayload($payload);
            $this->emit($type, [$payload, $this]);
        }

        return $update;
    }

    /** Keeps the chats and users an update mentions in the local caches. */
    private function cachePayload(mixed $payload): void
    {
        if (! $payload instanceof Part) {
            return;
        }

        if (($chat = $payload->chat ?? null) !== null) {
            $this->chats->cache($chat);
        }

        foreach (['from', 'user'] as $key) {
            if (($user = $payload->{$key} ?? null) !== null) {
                $this->users->cache($user);
            }
        }
    }

    // -- Calling ------------------------------------------------------------

    /**
     * Dispatches one Bot API call - the hook the generated {@see Methods} trait
     * calls into.
     *
     * @param array<string, mixed> $arguments The method's arguments, unset ones included.
     * @param list<string>         $returns   Telegram type tokens the result hydrates as.
     *
     * @return PromiseInterface<mixed>
     */
    protected function callApi(string $method, array $arguments, array $returns): PromiseInterface
    {
        return $this->request($method, $arguments, $returns);
    }

    /**
     * Calls any Bot API method by name, including one this build has no generated
     * method for - a new method on a Bot API server that is ahead of the bundled
     * spec, for instance.
     *
     * @param array<string, mixed> $payload
     * @param list<string>         $returns Telegram type tokens; empty leaves the result raw.
     *
     * @return PromiseInterface<mixed>
     */
    public function request(string $method, array $payload = [], array $returns = []): PromiseInterface
    {
        return $this->http->execute($method, $payload)
            ->then(fn (mixed $result): mixed => $this->hydrate($returns, $result));
    }

    /**
     * Builds the result of a call into parts.
     *
     * A few methods return one of two things - `editMessageText` answers with the
     * edited {@see \Telegram\Parts\Message}, or with `true` when the message is an
     * inline one the bot cannot read back - so the token that matches the shape
     * actually returned wins.
     *
     * @param list<string> $returns
     */
    protected function hydrate(array $returns, mixed $result): mixed
    {
        if ($returns === [] || $result === null) {
            return $result;
        }

        if (count($returns) === 1) {
            return $this->factory->create($returns[0], $result);
        }

        foreach ($returns as $token) {
            $isScalarToken = in_array($token, ['Boolean', 'Integer', 'String', 'Float'], true);

            if ($isScalarToken && is_scalar($result)) {
                return $this->factory->create($token, $result);
            }

            if (! $isScalarToken && (is_array($result) || is_object($result))) {
                return $this->factory->create($token, $result);
            }
        }

        return $result;
    }

    /**
     * Downloads a file - either a {@see File} from `getFile`, or a `file_id` this
     * resolves first.
     *
     * @return PromiseInterface<string> The file's bytes.
     */
    public function downloadFile(File|string $file): PromiseInterface
    {
        $path = $file instanceof File
            ? resolve($file->file_path)
            : $this->getFile($file)->then(static fn (File $resolved): ?string => $resolved->file_path);

        return $path->then(function (?string $filePath): PromiseInterface {
            if ($filePath === null) {
                throw new Exceptions\TelegramException('Telegram did not return a file_path for this file.');
            }

            // A local Bot API server answers with a path on its own disk, and
            // serves nothing over HTTP; read it from there instead.
            return LocalFiles::isLocalPath($filePath)
                ? $this->localFiles->read($this->localFiles->toLocal($filePath))
                : $this->http->download($filePath);
        });
    }

    /**
     * Where a file is on this process's disk, when the server is a local one
     * running with `--local`.
     *
     * For the files a local server exists to allow — up to 2000 MB — reading
     * them into a string is the wrong move; open or copy the path instead, or
     * use {@see \Telegram\Parts\File::save()}, which copies without holding the
     * file in memory.
     *
     * @return PromiseInterface<?string> The path, or `null` when the file is on
     *                                   Telegram's own servers and has to be
     *                                   downloaded.
     */
    public function localFilePath(File|string $file): PromiseInterface
    {
        $path = $file instanceof File
            ? resolve($file->file_path)
            : $this->getFile($file)->then(static fn (File $resolved): ?string => $resolved->file_path);

        return $path->then(fn (?string $filePath): ?string => LocalFiles::isLocalPath($filePath)
            ? $this->localFiles->toLocal((string) $filePath)
            : null);
    }

    // -- Accessors ----------------------------------------------------------

    public function getLoop(): LoopInterface
    {
        return $this->loop;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function getHttp(): HttpInterface
    {
        return $this->http;
    }

    /**
     * The files a local Bot API server shares with this process — for turning
     * a local path into the `file://` URI an upload can use instead of bytes.
     */
    public function getLocalFiles(): LocalFiles
    {
        return $this->localFiles;
    }

    public function getFactory(): Factory
    {
        return $this->factory;
    }

    /** The bot's own account, once {@see start()} has resolved. */
    public function getBotUser(): ?User
    {
        return $this->botUser;
    }

    public function isReady(): bool
    {
        return $this->ready;
    }

    /**
     * One client option.
     *
     * @return mixed
     */
    public function getOption(string $name, mixed $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }

    public function getPoller(): ?Poller
    {
        return $this->poller;
    }

    public function getWebhookServer(): ?Server
    {
        return $this->webhook;
    }

    /** Lazily builds the repository caches. */
    public function __get(string $name): mixed
    {
        if (! isset(self::REPOSITORIES[$name])) {
            throw new \InvalidArgumentException('Undefined property ' . static::class . '::$' . $name);
        }

        return $this->repositories[$name] ??= new (self::REPOSITORIES[$name])($this);
    }

    public function __isset(string $name): bool
    {
        return isset(self::REPOSITORIES[$name]);
    }
}
