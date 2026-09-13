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

use Discord\Helpers\Collection;

use function React\Async\await;

use React\EventLoop\Loop;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as OptionsException;
use Telegram\Http\Http;
use Telegram\Parts\Chat;
use Telegram\Parts\ChatFullInfo;
use Telegram\Parts\File;
use Telegram\Parts\Message;
use Telegram\Parts\User;
use Telegram\Repository\ChatRepository;
use Telegram\Repository\UserRepository;
use Telegram\Telegram;

/**
 * The client itself: how it is configured, how it turns results into parts, and
 * what its caches do.
 */
final class ClientTest extends SpecTestCase
{
    private ScriptedHttp $http;

    private Telegram $telegram;

    protected function setUp(): void
    {
        $this->http = new ScriptedHttp();
        $this->telegram = $this->client($this->http);
    }

    public function testATokenIsRequired(): void
    {
        $this->expectException(OptionsException::class);

        new Telegram();
    }

    public function testUnknownOptionsAreRefused(): void
    {
        $this->expectException(OptionsException::class);

        new Telegram(['token' => 'TEST:TOKEN', 'polling_interval' => 5]);
    }

    public function testTheDefaultsAreSensible(): void
    {
        $telegram = new Telegram(['token' => 'TEST:TOKEN']);

        $this->assertSame(Loop::get(), $telegram->getLoop());
        $this->assertInstanceOf(Http::class, $telegram->getHttp());
        $this->assertSame(50, $telegram->getOption('poll_timeout'));
        $this->assertSame(Http::BASE_URL, $telegram->getOption('base_url'));
        $this->assertFalse($telegram->isReady());
        $this->assertNull($telegram->getBotUser());
    }

    public function testAResultIsHydratedIntoItsPart(): void
    {
        $this->http->script = [[
            'message_id' => 11,
            'date' => 1700000000,
            'chat' => ['id' => 5, 'type' => 'private'],
            'text' => 'hi',
        ]];

        $message = await($this->telegram->sendMessage(5, 'hi'));

        $this->assertInstanceOf(Message::class, $message);
        $this->assertSame('hi', $message->text);
        $this->assertInstanceOf(Chat::class, $message->chat);
    }

    public function testAListResultBecomesACollectionOfParts(): void
    {
        $this->http->script = [[
            ['update_id' => 1],
            ['update_id' => 2],
        ]];

        $updates = await($this->telegram->getUpdates());

        $this->assertInstanceOf(Collection::class, $updates);
        $this->assertCount(2, $updates);
    }

    public function testAMethodThatReturnsEitherAMessageOrTrueHandlesBoth(): void
    {
        $this->http->script = [
            ['message_id' => 11, 'date' => 1700000000, 'chat' => ['id' => 5, 'type' => 'private'], 'text' => 'edited'],
            true,
        ];

        $edited = await($this->telegram->editMessageText('edited', chat_id: 5, message_id: 11));
        $inline = await($this->telegram->editMessageText('edited', inline_message_id: 'inline-1'));

        $this->assertInstanceOf(Message::class, $edited, 'An ordinary message comes back as a Message.');
        $this->assertTrue($inline, 'An inline message the bot cannot read back comes back as true.');
    }

    public function testABooleanResultStaysABoolean(): void
    {
        $this->http->default = true;

        $this->assertTrue(await($this->telegram->deleteMessage(5, 11)));
    }

    public function testAnUnknownMethodCanStillBeCalled(): void
    {
        // A Bot API server ahead of the bundled spec, or a local server with an
        // extension of its own.
        $this->http->script = [['ok' => 'sure']];

        $result = await($this->telegram->request('someFutureMethod', ['chat_id' => 5]));

        $this->assertSame(['ok' => 'sure'], $result);
        $this->assertSame(['someFutureMethod', ['chat_id' => 5]], $this->http->lastCall());
    }

    public function testDownloadingAFileResolvesItsPathFirst(): void
    {
        $this->http->script = [['file_id' => 'f-1', 'file_unique_id' => 'u-1', 'file_path' => 'photos/file_1.jpg']];

        $this->assertSame('file-bytes', await($this->telegram->downloadFile('f-1')));
        $this->assertSame(['getFile', ['file_id' => 'f-1']], $this->http->calls[0]);
        $this->assertSame(['@download', ['file_path' => 'photos/file_1.jpg']], $this->http->calls[1]);
    }

    public function testDownloadingAFilePartSkipsTheLookup(): void
    {
        /** @var File $file */
        $file = $this->telegram->getFactory()->part(File::class, [
            'file_id' => 'f-1',
            'file_unique_id' => 'u-1',
            'file_path' => 'photos/file_1.jpg',
        ]);

        $this->assertSame('file-bytes', await($this->telegram->downloadFile($file)));
        $this->assertCount(1, $this->http->calls);
    }

    public function testTheRepositoriesAreLazyAndShared(): void
    {
        $this->assertInstanceOf(ChatRepository::class, $this->telegram->chats);
        $this->assertInstanceOf(UserRepository::class, $this->telegram->users);
        $this->assertSame($this->telegram->chats, $this->telegram->chats);
        $this->assertTrue(isset($this->telegram->users));
    }

    public function testAnUnknownPropertyIsAnError(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->telegram->nowhere;
    }

    public function testFetchingAChatCachesAndUpgradesIt(): void
    {
        $this->telegram->chats->cache($this->telegram->getFactory()->part(Chat::class, [
            'id' => -100,
            'type' => 'supergroup',
            'title' => 'Ops',
        ]));

        $this->http->script = [[
            'id' => -100,
            'type' => 'supergroup',
            'title' => 'Ops',
            'description' => 'Where the deploys happen',
            'accent_color_id' => 1,
            'max_reaction_count' => 11,
        ]];

        $chat = await($this->telegram->chats->fetch(-100));

        $this->assertInstanceOf(ChatFullInfo::class, $chat);
        $this->assertSame('Where the deploys happen', $chat->description);
        $this->assertCount(1, $this->telegram->chats, 'A fetch updates the cached chat rather than adding a second.');
        $this->assertSame('Where the deploys happen', $this->telegram->chats->get(-100)->description);
    }

    public function testACachedChatIsReusedInsteadOfFetched(): void
    {
        $this->telegram->chats->cache($this->telegram->getFactory()->part(Chat::class, ['id' => 5, 'type' => 'private']));

        $chat = await($this->telegram->chats->fetchOrGet(5));

        $this->assertSame(5, $chat->id);
        $this->assertSame([], $this->http->calls, 'A cached chat needs no call.');
    }

    public function testChatsCanBeLookedUpByAStringId(): void
    {
        $this->telegram->chats->cache($this->telegram->getFactory()->part(Chat::class, ['id' => -100, 'type' => 'supergroup']));

        $this->assertNotNull($this->telegram->chats->get('-100'), 'An id out of a config file is still that id.');
        $this->assertTrue($this->telegram->chats->has(-100));
    }

    public function testAUserCannotBeLookedUpByIdAlone(): void
    {
        $this->expectException(\BadMethodCallException::class);

        $this->telegram->users->fetch(7);
    }

    public function testAUserIsCachedFromTheirMembership(): void
    {
        $this->http->script = [[
            'status' => 'member',
            'user' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
        ]];

        $member = await($this->telegram->users->fetchMember(-100, 7));

        $this->assertInstanceOf(\Telegram\Parts\ChatMemberMember::class, $member);
        $this->assertInstanceOf(User::class, $this->telegram->users->get(7));
    }

    public function testTheCachesCanBeCleared(): void
    {
        $this->telegram->chats->cache($this->telegram->getFactory()->part(Chat::class, ['id' => 5, 'type' => 'private']));

        $this->assertCount(1, $this->telegram->chats);

        $this->telegram->chats->clear();

        $this->assertCount(0, $this->telegram->chats);
    }

    public function testAFailedStartSurfacesTheError(): void
    {
        $this->http->throw = new \Telegram\Http\Exceptions\UnauthorizedException('Unauthorized', 401);

        $errors = [];
        $this->telegram->on(\Telegram\Events\Event::ERROR, static function (\Throwable $e) use (&$errors): void {
            $errors[] = $e;
        });

        $this->expectException(\Telegram\Http\Exceptions\UnauthorizedException::class);

        try {
            await($this->telegram->start());
        } finally {
            $this->assertCount(1, $errors);
            $this->assertFalse($this->telegram->isReady());
        }
    }
}
