<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Webhook;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Telegram\Events\Event;
use Telegram\Exceptions\PollingException;
use Telegram\Telegram;

/**
 * The other update source: an HTTP listener Telegram posts updates to.
 *
 * Telegram requires the public endpoint to be HTTPS, so in practice this listens
 * on plain HTTP behind a reverse proxy that terminates TLS. Requests are checked
 * against the `secret_token` registered with `setWebhook` - the only thing that
 * distinguishes a real delivery from anyone else who found the URL - and
 * answered `200` as soon as the update is queued, because Telegram retries
 * anything slower.
 *
 * ```php
 * $telegram = new Telegram([
 *     'token' => $token,
 *     'webhook' => ['listen' => '0.0.0.0:8080', 'path' => '/hook', 'secret_token' => $secret],
 * ]);
 * $telegram->setWebhook('https://bot.example.com/hook', secret_token: $secret);
 * $telegram->run();
 * ```
 *
 * @link https://core.telegram.org/bots/api#setwebhook
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Server
{
    /** @var array<string, mixed> */
    private array $options;

    private ?HttpServer $http = null;

    private ?SocketServer $socket = null;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(private readonly Telegram $telegram, array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setDefined(['secret_token', 'socket_context'])
            ->setDefaults([
                'listen' => '0.0.0.0:8080',
                'path' => '/',
            ])
            ->setAllowedTypes('listen', 'string')
            ->setAllowedTypes('path', 'string')
            ->setAllowedTypes('secret_token', ['null', 'string'])
            ->setAllowedTypes('socket_context', 'array');

        $this->options = $resolver->resolve($options);
    }

    /**
     * Binds the socket and starts accepting deliveries.
     *
     * @throws PollingException When the address cannot be bound.
     */
    public function listen(): void
    {
        if ($this->socket !== null) {
            return;
        }

        $this->http = new HttpServer($this->telegram->getLoop(), $this->handle(...));

        try {
            $this->socket = new SocketServer(
                $this->options['listen'],
                $this->options['socket_context'] ?? [],
                $this->telegram->getLoop(),
            );
        } catch (\Throwable $e) {
            throw new PollingException("Could not listen on {$this->options['listen']}: {$e->getMessage()}", 0, $e);
        }

        $this->http->listen($this->socket);
        $this->telegram->getLogger()->info("Webhook listening on {$this->options['listen']}{$this->options['path']}");
    }

    public function close(): void
    {
        $this->socket?->close();
        $this->socket = null;
        $this->http = null;
    }

    /** The address the listener is bound to, once it is listening. */
    public function getAddress(): ?string
    {
        return $this->socket?->getAddress();
    }

    private function handle(ServerRequestInterface $request): Response
    {
        if ($request->getMethod() !== 'POST' || $request->getUri()->getPath() !== $this->options['path']) {
            return new Response(404, [], "Not Found\n");
        }

        $secret = $this->options['secret_token'] ?? null;

        if ($secret !== null && ! hash_equals($secret, $request->getHeaderLine('X-Telegram-Bot-Api-Secret-Token'))) {
            $this->telegram->getLogger()->warning('Rejected a webhook delivery with a bad secret token.');

            return new Response(403, [], "Forbidden\n");
        }

        $decoded = json_decode((string) $request->getBody(), true);

        if (! is_array($decoded)) {
            return new Response(400, [], "Bad Request\n");
        }

        try {
            $this->telegram->handleUpdate($decoded);
        } catch (\Throwable $e) {
            // Answer 200 anyway: Telegram redelivers on anything else, and a
            // handler bug is not something redelivery will fix.
            $this->telegram->getLogger()->error('Update handler threw: ' . $e->getMessage(), ['exception' => $e]);
            $this->telegram->emit(Event::ERROR, [$e, $this->telegram]);
        }

        return new Response(200, ['Content-Type' => 'application/json'], '{"ok":true}');
    }
}
