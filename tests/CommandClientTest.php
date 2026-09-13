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

use Telegram\CommandClient\Command;
use Telegram\CommandClient\TelegramCommandClient;
use Telegram\Events\Event;
use Telegram\Parts\Message;

/**
 * Slash-command routing: what counts as a command, what the callback receives,
 * and what happens to what it returns.
 */
final class CommandClientTest extends SpecTestCase
{
    private ScriptedHttp $http;

    private TelegramCommandClient $bot;

    protected function setUp(): void
    {
        $this->http = new ScriptedHttp();
        $this->http->default = [];
        $this->bot = new TelegramCommandClient([
            'token' => 'TEST:TOKEN',
            'http' => $this->http,
            'description' => 'A helpful bot',
        ]);
    }

    protected function tearDown(): void
    {
        $this->bot->stop();
    }

    private function incoming(string $text): void
    {
        $this->bot->handleUpdate([
            'update_id' => 1,
            'message' => [
                'message_id' => 3,
                'date' => 1700000000,
                'chat' => ['id' => 5, 'type' => 'group', 'title' => 'Ops'],
                'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
                'text' => $text,
            ],
        ]);
    }

    public function testACommandIsRoutedAndItsReturnSentAsAReply(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong');

        $this->incoming('/ping');

        [$method, $payload] = $this->http->lastCall();

        $this->assertSame('sendMessage', $method);
        $this->assertSame('pong', $payload['text']);
        $this->assertSame(5, $payload['chat_id']);
        $this->assertSame(['message_id' => 3], $payload['reply_parameters']);
    }

    public function testTheCallbackReceivesTheMessageArgumentsAndClient(): void
    {
        $seen = [];

        $this->bot->registerCommand('echo', static function (Message $message, array $args, TelegramCommandClient $client) use (&$seen): string {
            $seen = ['message' => $message, 'args' => $args, 'client' => $client];

            return implode('|', $args);
        });

        $this->incoming('/echo one  two three');

        $this->assertInstanceOf(Message::class, $seen['message']);
        $this->assertSame(['one', 'two', 'three'], $seen['args']);
        $this->assertSame($this->bot, $seen['client']);
        $this->assertSame('one|two|three', $this->http->lastPayload()['text']);
    }

    public function testACallbackThatReturnsNothingSendsNothing(): void
    {
        $this->bot->registerCommand('quiet', static fn (): ?string => null);

        $this->incoming('/quiet');

        $this->assertSame([], $this->http->calls, 'A command that answers nothing should send nothing.');
    }

    public function testCommandsAreMatchedWithoutRegardToCase(): void
    {
        $this->bot->registerCommand('Ping', static fn (): string => 'pong');

        $this->incoming('/PING');

        $this->assertSame('pong', $this->http->lastPayload()['text']);
    }

    public function testAliasesAnswerToo(): void
    {
        $this->bot->registerCommand('status', static fn (): string => 'green', ['aliases' => ['st', 'stat']]);

        $this->incoming('/stat');

        $this->assertSame('green', $this->http->lastPayload()['text']);
    }

    public function testACommandAddressedToThisBotIsHandled(): void
    {
        $this->http->script = [['id' => 1, 'is_bot' => true, 'first_name' => 'Bot', 'username' => 'mybot']];
        $this->bot->start();
        $this->http->reset();

        $this->bot->registerCommand('ping', static fn (): string => 'pong');

        $this->incoming('/ping@mybot');

        $this->assertSame('sendMessage', $this->http->lastMethod());
        $this->assertSame('pong', $this->http->lastPayload()['text']);
    }

    public function testACommandAddressedToAnotherBotIsIgnored(): void
    {
        $this->http->script = [['id' => 1, 'is_bot' => true, 'first_name' => 'Bot', 'username' => 'mybot']];
        $this->bot->start();
        $this->http->reset();

        $this->bot->registerCommand('ping', static fn (): string => 'pong');

        $this->incoming('/ping@otherbot');

        $this->assertSame([], $this->http->calls);
    }

    public function testTextThatIsNotACommandIsIgnored(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong');

        $this->incoming('ping');
        $this->incoming('/unknown');

        $this->assertSame([], $this->http->calls);
    }

    public function testTheHelpCommandListsWhatIsRegistered(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong', ['description' => 'Checks the bot is alive']);
        $this->bot->registerCommand('secret', static fn (): string => 'shh', ['listed' => false]);

        $this->incoming('/help');

        $text = $this->http->lastPayload()['text'];

        $this->assertStringContainsString('A helpful bot', $text);
        $this->assertStringContainsString('/ping - Checks the bot is alive', $text);
        $this->assertStringNotContainsString('/secret', $text, 'Unlisted commands stay out of the menu.');
    }

    public function testCommandsArePublishedToTelegram(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong', ['description' => 'Checks the bot is alive']);
        $this->bot->registerCommand('secret', static fn (): string => 'shh', ['listed' => false]);

        $this->bot->publishCommands();

        [$method, $payload] = $this->http->lastCall();

        $this->assertSame('setMyCommands', $method);
        $this->assertContains(['command' => 'ping', 'description' => 'Checks the bot is alive'], $payload['commands']);
        $this->assertNotContains('secret', array_column($payload['commands'], 'command'));
    }

    public function testTheCommandMenuIsPublishedOnceTheBotIsReady(): void
    {
        $this->http->script = [['id' => 1, 'is_bot' => true, 'first_name' => 'Bot', 'username' => 'mybot']];

        $this->bot->registerCommand('ping', static fn (): string => 'pong');
        $this->bot->start();

        $this->assertContains('setMyCommands', array_column($this->http->calls, 0));
    }

    public function testRegisteringTheSameCommandTwiceIsRefused(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong');

        $this->expectException(\InvalidArgumentException::class);

        $this->bot->registerCommand('ping', static fn (): string => 'pong again');
    }

    public function testACommandCanBeForgotten(): void
    {
        $this->bot->registerCommand('ping', static fn (): string => 'pong', ['aliases' => ['p']]);

        $this->assertInstanceOf(Command::class, $this->bot->getCommand('p'));

        $this->bot->unregisterCommand('ping');

        $this->assertNull($this->bot->getCommand('ping'));
        $this->assertNull($this->bot->getCommand('p'), 'Aliases go with the command.');

        $this->incoming('/ping');

        $this->assertSame([], $this->http->calls);
    }

    public function testACommandThatThrowsIsReportedRatherThanEscaping(): void
    {
        $errors = [];
        $this->bot->on(Event::ERROR, static function (\Throwable $e) use (&$errors): void {
            $errors[] = $e;
        });

        $this->bot->registerCommand('boom', static function (): string {
            throw new \RuntimeException('command blew up');
        });

        $this->incoming('/boom');

        $this->assertCount(1, $errors);
        $this->assertSame('command blew up', $errors[0]->getMessage());
        $this->assertSame([], $this->http->calls);
    }

    public function testThePrefixCanBeChanged(): void
    {
        $bot = new TelegramCommandClient([
            'token' => 'TEST:TOKEN',
            'http' => $http = new ScriptedHttp(),
            'prefix' => '!',
            'help_command' => null,
        ]);

        $bot->registerCommand('ping', static fn (): string => 'pong');

        $bot->handleUpdate([
            'update_id' => 1,
            'message' => [
                'message_id' => 3,
                'date' => 1700000000,
                'chat' => ['id' => 5, 'type' => 'private'],
                'text' => '!ping',
            ],
        ]);

        $this->assertSame('pong', $http->lastPayload()['text']);
        $this->assertNull($bot->getCommand('help'), 'The built-in help can be turned off.');
    }
}
