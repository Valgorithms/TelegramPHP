<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;

use function React\Promise\reject;

use Telegram\Http\Drivers\React as ReactDriver;
use Telegram\Http\Exceptions\HttpException;
use Telegram\Http\Exceptions\TooManyRequestsException;

/**
 * Non-blocking transport for the Telegram Bot API.
 *
 * Every call is a `POST` to `/bot<token>/<method>`, queued behind a concurrency
 * ceiling, encoded as JSON - or as `multipart/form-data` the moment the payload
 * carries an {@see \Telegram\Builders\InputFile}. A `429` is held for exactly the
 * `retry_after` Telegram asks for and then replayed; transient `5xx` and
 * transport failures back off exponentially. Successful calls resolve with the
 * `result` member of the envelope, already unwrapped.
 *
 * Point {@see $baseUrl} at a local Bot API server to lift the official file-size
 * limits.
 *
 * @link https://core.telegram.org/bots/api#making-requests
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Http implements HttpInterface
{
    public const VERSION = '1.0.0';

    /** The official Bot API server. */
    public const BASE_URL = 'https://api.telegram.org';

    /** In-flight request ceiling. */
    public const CONCURRENT_REQUESTS = 8;

    /** Give up after this many attempts at one request. */
    public const MAX_ATTEMPTS = 4;

    private LoggerInterface $logger;

    private ?DriverInterface $driver;

    /** @var \SplQueue<Request> */
    private \SplQueue $queue;

    private int $inFlight = 0;

    /** Set while the client is serving a `retry_after` hold-off. */
    private bool $throttled = false;

    public function __construct(
        private string $token,
        private readonly LoopInterface $loop,
        ?LoggerInterface $logger = null,
        ?DriverInterface $driver = null,
        private readonly string $baseUrl = self::BASE_URL,
    ) {
        $this->logger = $logger ?? new NullLogger();
        $this->driver = $driver;
        $this->queue = new \SplQueue();
    }

    /**
     * Convenience constructor that wires the default ReactPHP driver against the
     * shared event loop.
     *
     * @param array<string, mixed> $socketOptions Forwarded to the socket connector.
     */
    public static function create(
        string $token,
        ?LoggerInterface $logger = null,
        ?LoopInterface $loop = null,
        array $socketOptions = [],
        string $baseUrl = self::BASE_URL,
    ): self {
        $loop ??= Loop::get();

        return new self($token, $loop, $logger, new ReactDriver($loop, $socketOptions), $baseUrl);
    }

    public function setDriver(DriverInterface $driver): void
    {
        $this->driver = $driver;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param array<string, mixed> $content
     *
     * @return PromiseInterface<mixed>
     */
    public function execute(string $method, array $content = []): PromiseInterface
    {
        if ($this->driver === null) {
            return reject(new HttpException('No HTTP driver configured. Pass one to the constructor or call Http::create().'));
        }

        $content = array_filter($content, static fn ($value): bool => $value !== null);

        try {
            [$body, $headers] = $this->encode($content);
        } catch (\JsonException $e) {
            return reject(new HttpException("Could not encode the payload for {$method}: {$e->getMessage()}", 0, null, [], $e));
        }

        $deferred = new Deferred();
        $this->queue->enqueue(new Request($deferred, $method, $this->methodUrl($method), $body, $headers));
        $this->pump();

        return $deferred->promise();
    }

    /**
     * @return PromiseInterface<string>
     */
    public function download(string $filePath): PromiseInterface
    {
        if ($this->driver === null) {
            return reject(new HttpException('No HTTP driver configured. Pass one to the constructor or call Http::create().'));
        }

        $deferred = new Deferred();
        $this->queue->enqueue(new Request($deferred, $filePath, $this->fileUrl($filePath), '', [], 'GET'));
        $this->pump();

        return $deferred->promise();
    }

    public function fileUrl(string $filePath): string
    {
        return $this->baseUrl . '/file/bot' . $this->token . '/' . ltrim($filePath, '/');
    }

    /** The absolute URL one Bot API method is called at. */
    public function methodUrl(string $method): string
    {
        return $this->baseUrl . '/bot' . $this->token . '/' . $method;
    }

    /**
     * Chooses the wire format: JSON for ordinary calls, multipart the moment the
     * payload carries a file.
     *
     * @param array<string, mixed> $content
     *
     * @return array{0: string, 1: array<string, string>}
     *
     * @throws \JsonException
     */
    private function encode(array $content): array
    {
        if ($content === []) {
            return ['', []];
        }

        if (Multipart::containsFile($content)) {
            $multipart = Multipart::encode($content);

            return [(string) $multipart, ['Content-Type' => $multipart->getContentType()]];
        }

        $json = json_encode($content, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return [$json, ['Content-Type' => 'application/json']];
    }

    /** Dispatches queued requests up to the concurrency ceiling. */
    private function pump(): void
    {
        if ($this->throttled) {
            return;
        }

        while ($this->inFlight < self::CONCURRENT_REQUESTS && ! $this->queue->isEmpty()) {
            $this->send($this->queue->dequeue());
        }
    }

    private function send(Request $request): void
    {
        $request->setHeader('Accept', 'application/json');
        $request->setHeader('User-Agent', 'TelegramPHP/' . self::VERSION . ' (+https://github.com/Valgorithms/TelegramPHP)');
        $attempt = $request->bumpAttempts();
        ++$this->inFlight;

        $this->logger->debug("→ {$request}" . ($attempt > 1 ? " (attempt {$attempt})" : ''));

        $this->driver->runRequest($request)->then(
            function (ResponseInterface $response) use ($request): void {
                --$this->inFlight;
                $this->handleResponse($request, $response);
            },
            function (\Throwable $e) use ($request): void {
                --$this->inFlight;

                if ($request->getAttempts() < self::MAX_ATTEMPTS) {
                    $this->logger->warning("transport error on {$request}: {$e->getMessage()} — retrying");
                    $this->retry($request, 1.0 * $request->getAttempts());

                    return;
                }

                $request->getDeferred()->reject(new HttpException("Transport error on {$request}: {$e->getMessage()}", 0, null, [], $e));
                $this->pump();
            },
        );
    }

    private function handleResponse(Request $request, ResponseInterface $response): void
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($request->getMethod() === 'GET') {
            // A file download: the body is the file, not an envelope.
            if ($status >= 200 && $status < 300) {
                $request->getDeferred()->resolve($body);
                $this->pump();

                return;
            }

            $request->getDeferred()->reject(HttpException::fromResponse($response, $this->decode($body)));
            $this->pump();

            return;
        }

        $decoded = $this->decode($body);

        if ($status === 429) {
            $this->handleRateLimit($request, $response, $decoded);

            return;
        }

        if (($status >= 500 || $status === 408) && $request->getAttempts() < self::MAX_ATTEMPTS) {
            $this->logger->warning("{$status} on {$request} — retrying");
            $this->retry($request, 0.5 * (2 ** ($request->getAttempts() - 1)));

            return;
        }

        if ($status < 200 || $status >= 300 || ($decoded['ok'] ?? false) !== true) {
            $request->getDeferred()->reject(HttpException::fromResponse($response, $decoded));
            $this->pump();

            return;
        }

        $request->getDeferred()->resolve($decoded['result'] ?? null);
        $this->pump();
    }

    /**
     * Holds the whole queue for `retry_after` seconds, then replays the request -
     * Telegram's limits are per bot, so racing ahead with other calls only earns
     * more 429s.
     *
     * @param array<string, mixed>|null $decoded
     */
    private function handleRateLimit(Request $request, ResponseInterface $response, ?array $decoded): void
    {
        $wait = (float) ($decoded['parameters']['retry_after']
            ?? ($response->getHeaderLine('Retry-After') ?: 1));

        if ($request->getAttempts() >= self::MAX_ATTEMPTS) {
            $this->logger->error("429 on {$request} after " . self::MAX_ATTEMPTS . ' attempts — giving up');
            $request->getDeferred()->reject(new TooManyRequestsException(
                (string) ($decoded['description'] ?? "Rate limited on {$request}"),
                429,
                $response,
                is_array($decoded['parameters'] ?? null) ? $decoded['parameters'] : [],
            ));
            $this->pump();

            return;
        }

        $this->logger->warning("429 on {$request}; holding {$wait}s");
        $this->throttled = true;
        $this->loop->addTimer(max(0.1, $wait), function () use ($request): void {
            $this->throttled = false;
            $this->queue->unshift($request);
            $this->pump();
        });
    }

    private function retry(Request $request, float $delay): void
    {
        $this->loop->addTimer(max(0.0, $delay), function () use ($request): void {
            $this->queue->unshift($request);
            $this->pump();
        });
    }

    /** @return array<string, mixed>|null */
    private function decode(string $body): ?array
    {
        if ($body === '') {
            return null;
        }

        $decoded = json_decode($body, true);

        return is_array($decoded) ? $decoded : null;
    }
}
