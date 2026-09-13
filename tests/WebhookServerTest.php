<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Tests;

use Psr\Http\Message\ResponseInterface;
use React\Http\Message\ServerRequest;
use Telegram\Events\Event;
use Telegram\Parts\Message;
use Telegram\Webhook\Server;

/**
 * The webhook listener: what it accepts, what it turns away, and what it does
 * with a delivery.
 *
 * The handler is exercised directly rather than over a socket, so these tests
 * bind no ports.
 */
final class WebhookServerTest extends SpecTestCase
{
    private ScriptedHttp $http;

    private \Telegram\Telegram $telegram;

    protected function setUp(): void
    {
        $this->http = new ScriptedHttp();
        $this->telegram = $this->client($this->http);
    }

    private function server(array $options = []): Server
    {
        return new Server($this->telegram, $options + ['path' => '/hook', 'secret_token' => 's3cret']);
    }

    private function deliver(Server $server, ServerRequest $request): ResponseInterface
    {
        $handle = (new \ReflectionClass($server))->getMethod('handle');

        return $handle->invoke($server, $request);
    }

    private static function delivery(array $body, array $headers = ['X-Telegram-Bot-Api-Secret-Token' => 's3cret']): ServerRequest
    {
        return new ServerRequest('POST', 'http://localhost/hook', $headers, json_encode($body));
    }

    public function testAValidDeliveryIsAcceptedAndEmitted(): void
    {
        $seen = null;
        $this->telegram->on(Event::MESSAGE, static function (Message $message) use (&$seen): void {
            $seen = $message;
        });

        $response = $this->deliver($this->server(), self::delivery([
            'update_id' => 1,
            'message' => [
                'message_id' => 3,
                'date' => 1700000000,
                'chat' => ['id' => 5, 'type' => 'private'],
                'text' => 'hello',
            ],
        ]));

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('{"ok":true}', (string) $response->getBody());
        $this->assertInstanceOf(Message::class, $seen);
        $this->assertSame('hello', $seen->text);
    }

    public function testADeliveryWithTheWrongSecretIsRefused(): void
    {
        $emitted = false;
        $this->telegram->on(Event::UPDATE, static function () use (&$emitted): void {
            $emitted = true;
        });

        $response = $this->deliver($this->server(), self::delivery(
            ['update_id' => 1],
            ['X-Telegram-Bot-Api-Secret-Token' => 'guessed'],
        ));

        $this->assertSame(403, $response->getStatusCode());
        $this->assertFalse($emitted, 'Nothing should be emitted for a delivery that failed the secret check.');
    }

    public function testADeliveryWithNoSecretIsRefusedWhenOneIsConfigured(): void
    {
        $response = $this->deliver($this->server(), self::delivery(['update_id' => 1], []));

        $this->assertSame(403, $response->getStatusCode());
    }

    public function testTheSecretCheckIsSkippedWhenNoneIsConfigured(): void
    {
        $server = new Server($this->telegram, ['path' => '/hook']);

        $response = $this->deliver($server, self::delivery(['update_id' => 1], []));

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testAnotherPathIsNotFound(): void
    {
        $request = new ServerRequest('POST', 'http://localhost/elsewhere', ['X-Telegram-Bot-Api-Secret-Token' => 's3cret'], '{}');

        $this->assertSame(404, $this->deliver($this->server(), $request)->getStatusCode());
    }

    public function testAGetIsNotFound(): void
    {
        $request = new ServerRequest('GET', 'http://localhost/hook');

        $this->assertSame(404, $this->deliver($this->server(), $request)->getStatusCode());
    }

    public function testAnUnreadableBodyIsABadRequest(): void
    {
        $request = new ServerRequest('POST', 'http://localhost/hook', ['X-Telegram-Bot-Api-Secret-Token' => 's3cret'], 'not json');

        $this->assertSame(400, $this->deliver($this->server(), $request)->getStatusCode());
    }

    public function testAHandlerThatThrowsStillAnswersOk(): void
    {
        // Telegram redelivers anything that is not a 2xx, and redelivery will not
        // fix a bug in a handler.
        $errors = [];
        $this->telegram->on(Event::ERROR, static function (\Throwable $e) use (&$errors): void {
            $errors[] = $e;
        });
        $this->telegram->on(Event::UPDATE, static function (): void {
            throw new \RuntimeException('handler blew up');
        });

        $response = $this->deliver($this->server(), self::delivery(['update_id' => 1]));

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $errors);
    }

    public function testTheClientUsesAWebhookInsteadOfPollingWhenConfigured(): void
    {
        $http = new ScriptedHttp();
        $http->script = [['id' => 1, 'is_bot' => true, 'first_name' => 'Bot', 'username' => 'mybot']];

        $telegram = new \Telegram\Telegram([
            'token' => 'TEST:TOKEN',
            'http' => $http,
            'webhook' => ['listen' => '127.0.0.1:0', 'path' => '/hook', 'secret_token' => 's3cret'],
        ]);

        $telegram->start();

        try {
            $this->assertNull($telegram->getPoller(), 'A configured webhook replaces long polling.');
            $this->assertInstanceOf(Server::class, $telegram->getWebhookServer());
            $this->assertNotNull($telegram->getWebhookServer()->getAddress());
            $this->assertSame('getMe', $http->calls[0][0]);
            $this->assertCount(1, $http->calls, 'A webhook bot does not call getUpdates.');
        } finally {
            $telegram->stop();
        }
    }
}
