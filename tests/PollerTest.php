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

use Telegram\Events\Event;
use Telegram\Http\Exceptions\ConflictException;
use Telegram\Parts\CallbackQuery;
use Telegram\Parts\Message;
use Telegram\Parts\Update;
use Telegram\Polling\Poller;

/**
 * Long polling: what it asks for, what it emits, and how it acknowledges.
 *
 * The transport here answers immediately, so a round completes the moment it
 * starts and the next one is left queued on the loop - which never runs in these
 * tests. That makes each `start()` exactly one round of polling.
 */
final class PollerTest extends SpecTestCase
{
    private ScriptedHttp $http;

    private \Telegram\Telegram $telegram;

    /** @var list<Poller> Pollers started by a test, stopped again when it ends. */
    private array $pollers = [];

    protected function setUp(): void
    {
        $this->http = new ScriptedHttp();
        $this->http->default = [];
        $this->telegram = $this->client($this->http);
    }

    protected function tearDown(): void
    {
        // A poller left running would keep queueing rounds on the shared loop,
        // which react runs on shutdown - and it would never come back.
        foreach ($this->pollers as $poller) {
            $poller->stop();
        }

        $this->telegram->stop();
        $this->pollers = [];
    }

    /** A poller this test case will stop for us. */
    private function poller(mixed ...$arguments): Poller
    {
        return $this->pollers[] = new Poller($this->telegram, ...$arguments);
    }

    private static function update(int $id, array $payload = []): array
    {
        return ['update_id' => $id] + ($payload ?: [
            'message' => [
                'message_id' => $id * 10,
                'date' => 1700000000,
                'chat' => ['id' => 5, 'type' => 'private'],
                'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
                'text' => 'hello',
            ],
        ]);
    }

    public function testTheFirstRoundAsksWithoutAnOffset(): void
    {
        $this->poller(timeout: 30, limit: 50)->start();

        [$method, $payload] = $this->http->lastCall();

        $this->assertSame('getUpdates', $method);
        $this->assertNull($payload['offset']);
        $this->assertSame(30, $payload['timeout']);
        $this->assertSame(50, $payload['limit']);
    }

    public function testAllowedUpdatesAreForwarded(): void
    {
        $this->poller(allowedUpdates: [Event::MESSAGE, Event::CALLBACK_QUERY])->start();

        $this->assertSame(['message', 'callback_query'], $this->http->lastPayload()['allowed_updates']);
    }

    public function testTheOffsetAdvancesPastTheHighestUpdateSeen(): void
    {
        $this->http->script = [[self::update(10), self::update(11), self::update(12)]];

        $poller = $this->poller();
        $poller->start();

        $this->assertSame(13, $poller->getOffset(), 'The next round must ask from one past the last update.');
    }

    public function testDroppingPendingUpdatesStartsFromTheEndOfTheQueue(): void
    {
        $poller = $this->poller(dropPendingUpdates: true);
        $poller->start();

        $this->assertSame(-1, $this->http->lastPayload()['offset']);
    }

    public function testEachUpdateIsEmittedTwice(): void
    {
        $this->http->script = [[self::update(1)]];

        $updates = [];
        $messages = [];

        $this->telegram->on(Event::UPDATE, static function (Update $update) use (&$updates): void {
            $updates[] = $update;
        });
        $this->telegram->on(Event::MESSAGE, static function (Message $message) use (&$messages): void {
            $messages[] = $message;
        });

        $this->poller()->start();

        $this->assertCount(1, $updates, 'Every update is emitted whole.');
        $this->assertCount(1, $messages, 'And again under its own type.');
        $this->assertSame(1, $updates[0]->update_id);
        $this->assertSame('hello', $messages[0]->text);
        $this->assertInstanceOf(Message::class, $messages[0]);
    }

    public function testUpdatesOfOtherTypesReachTheirOwnEvent(): void
    {
        $this->http->script = [[self::update(2, [
            'callback_query' => [
                'id' => 'q-1',
                'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
                'chat_instance' => 'ci',
                'data' => 'deploy:yes',
            ],
        ])]];

        $seen = null;
        $this->telegram->on(Event::CALLBACK_QUERY, static function (CallbackQuery $query) use (&$seen): void {
            $seen = $query;
        });

        $this->poller()->start();

        $this->assertInstanceOf(CallbackQuery::class, $seen);
        $this->assertSame('deploy:yes', $seen->data);
    }

    public function testChatsAndUsersFromUpdatesAreCached(): void
    {
        $this->http->script = [[self::update(3)]];

        $this->poller()->start();

        $this->assertCount(1, $this->telegram->chats);
        $this->assertCount(1, $this->telegram->users);
        $this->assertSame(5, $this->telegram->chats->get(5)->id);
        $this->assertSame('Ada', $this->telegram->users->get(7)->first_name);
    }

    public function testAHandlerThatThrowsDoesNotEndThePoll(): void
    {
        $this->http->script = [[self::update(4), self::update(5)]];

        $errors = [];
        $handled = 0;

        $this->telegram->on(Event::ERROR, static function (\Throwable $e) use (&$errors): void {
            $errors[] = $e;
        });
        $this->telegram->on(Event::MESSAGE, static function () use (&$handled): void {
            ++$handled;

            throw new \RuntimeException('handler blew up');
        });

        $poller = $this->poller();
        $poller->start();

        $this->assertSame(2, $handled, 'Both updates were still delivered.');
        $this->assertCount(2, $errors);
        $this->assertSame(6, $poller->getOffset(), 'And both were still acknowledged.');
    }

    public function testAFailedRoundIsReportedAndRetriedLater(): void
    {
        $this->http->throw = new ConflictException('Conflict: terminated by other getUpdates request', 409);

        $errors = [];
        $this->telegram->on(Event::ERROR, static function (\Throwable $e) use (&$errors): void {
            $errors[] = $e;
        });

        $poller = $this->poller();
        $poller->start();

        $this->assertCount(1, $errors);
        $this->assertInstanceOf(ConflictException::class, $errors[0]);
        $this->assertTrue($poller->isRunning(), 'A failed round does not stop the poller.');
    }

    public function testStoppingEndsThePolling(): void
    {
        $poller = $this->poller();
        $poller->start();

        $this->assertTrue($poller->isRunning());

        $poller->stop();

        $this->assertFalse($poller->isRunning());

        $calls = count($this->http->calls);
        $poller->start();
        $poller->stop();

        $this->assertGreaterThan($calls, count($this->http->calls), 'Starting again resumes polling.');
    }

    public function testTheClientStartsPollingWhenItIsReady(): void
    {
        $this->http->script = [
            ['id' => 1, 'is_bot' => true, 'first_name' => 'Bot', 'username' => 'mybot'],
        ];

        $ready = false;
        $this->telegram->on(Event::READY, static function () use (&$ready): void {
            $ready = true;
        });

        $this->telegram->start();

        $this->assertTrue($ready);
        $this->assertTrue($this->telegram->isReady());
        $this->assertSame('mybot', $this->telegram->getBotUser()->username);
        $this->assertInstanceOf(Poller::class, $this->telegram->getPoller());
        $this->assertSame('getUpdates', $this->http->lastMethod());

        $this->telegram->stop();

        $this->assertNull($this->telegram->getPoller());
    }
}
