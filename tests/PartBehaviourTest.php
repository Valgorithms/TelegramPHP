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

use Carbon\CarbonImmutable;

use function React\Async\await;

use Telegram\Parts\CallbackQuery;
use Telegram\Parts\Chat;
use Telegram\Parts\ChatJoinRequest;
use Telegram\Parts\File;
use Telegram\Parts\Message;
use Telegram\Parts\User;

/**
 * The hand-written behaviour the generator mixes into parts: what a message,
 * chat, user, callback query, or file can do with the client that built it.
 */
final class PartBehaviourTest extends SpecTestCase
{
    private ScriptedHttp $http;

    private \Telegram\Telegram $telegram;

    protected function setUp(): void
    {
        $this->http = new ScriptedHttp();
        $this->telegram = $this->client($this->http);
    }

    private function message(array $overrides = []): Message
    {
        return $this->telegram->getFactory()->part(Message::class, array_merge([
            'message_id' => 100,
            'date' => 1700000000,
            'chat' => ['id' => -1001234, 'type' => 'supergroup', 'title' => 'Ops'],
            'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada', 'username' => 'ada'],
            'text' => 'deploy please',
        ], $overrides));
    }

    public function testAMessageRepliesInItsOwnChatQuotingItself(): void
    {
        $this->message()->reply('on it');

        [$method, $payload] = $this->http->lastCall();

        $this->assertSame('sendMessage', $method);
        $this->assertSame(-1001234, $payload['chat_id']);
        $this->assertSame('on it', $payload['text']);
        $this->assertSame(['message_id' => 100], $payload['reply_parameters']);
    }

    public function testAMessageCanSpeakWithoutQuoting(): void
    {
        $this->message()->say('anyone there?');

        $payload = $this->http->lastPayload();

        $this->assertSame('sendMessage', $this->http->lastMethod());
        $this->assertArrayNotHasKey('reply_parameters', $payload);
    }

    public function testAReplyCarriesTheBusinessConnectionAndTopic(): void
    {
        $this->message(['business_connection_id' => 'biz-1', 'message_thread_id' => 55])->reply('sure');

        $payload = $this->http->lastPayload();

        $this->assertSame('biz-1', $payload['business_connection_id']);
        $this->assertSame(55, $payload['message_thread_id']);
    }

    public function testExtraOptionsWinOverTheDefaults(): void
    {
        $this->message()->reply('sure', ['chat_id' => 999, 'parse_mode' => 'HTML']);

        $payload = $this->http->lastPayload();

        $this->assertSame(999, $payload['chat_id']);
        $this->assertSame('HTML', $payload['parse_mode']);
    }

    public function testAMessageCanBeEditedDeletedForwardedAndCopied(): void
    {
        $message = $this->message();

        $message->edit('changed');
        $this->assertSame('editMessageText', $this->http->lastMethod());
        $this->assertSame(['chat_id' => -1001234, 'message_id' => 100, 'text' => 'changed', 'business_connection_id' => null], $this->http->lastPayload());

        $message->delete();
        $this->assertSame('deleteMessage', $this->http->lastMethod());

        $message->forward(42);
        $this->assertSame('forwardMessage', $this->http->lastMethod());
        $this->assertSame(['chat_id' => 42, 'from_chat_id' => -1001234, 'message_id' => 100], $this->http->lastPayload());

        $message->copy(42);
        $this->assertSame('copyMessage', $this->http->lastMethod());
    }

    public function testReactingWrapsEmojiInReactionTypes(): void
    {
        $this->message()->react('👍');

        $payload = $this->http->lastPayload();

        $this->assertSame('setMessageReaction', $this->http->lastMethod());
        $this->assertSame([['type' => 'emoji', 'emoji' => '👍']], $payload['reaction']);
        $this->assertFalse($payload['is_big']);

        $this->message()->react(null);

        $this->assertSame([], $this->http->lastPayload()['reaction'], 'Passing no emoji clears the reaction.');
    }

    public function testAMessageCanBePinned(): void
    {
        $this->message()->pin(disableNotification: true);

        $payload = $this->http->lastPayload();

        $this->assertSame('pinChatMessage', $this->http->lastMethod());
        $this->assertTrue($payload['disable_notification']);
    }

    public function testTimestampsReadBackAsDates(): void
    {
        $message = $this->message();

        $this->assertInstanceOf(CarbonImmutable::class, $message->date);
        $this->assertSame(1700000000, $message->date->getTimestamp());
        $this->assertSame(1700000000, $message->jsonSerialize()['date'], 'Serialisation keeps the original timestamp.');
    }

    public function testAChatSendsMessagesAndManagesMembers(): void
    {
        /** @var Chat $chat */
        $chat = $this->telegram->getFactory()->part(Chat::class, ['id' => -100, 'type' => 'supergroup', 'title' => 'Ops']);

        $chat->sendMessage('hello');
        $this->assertSame(['chat_id' => -100, 'text' => 'hello'], $this->http->lastPayload());

        $chat->sendAction('typing');
        $this->assertSame('sendChatAction', $this->http->lastMethod());

        $chat->ban(7, ['until_date' => 1800000000]);
        $this->assertSame(['chat_id' => -100, 'user_id' => 7, 'until_date' => 1800000000], $this->http->lastPayload());

        $chat->unban(7);
        $this->assertSame('unbanChatMember', $this->http->lastMethod());

        $chat->leave();
        $this->assertSame('leaveChat', $this->http->lastMethod());
    }

    public function testAUserIsNamedAndMentioned(): void
    {
        /** @var User $user */
        $user = $this->telegram->getFactory()->part(User::class, [
            'id' => 7,
            'is_bot' => false,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'username' => 'ada',
        ]);

        $this->assertSame('Ada Lovelace', $user->getFullName());
        $this->assertSame('@ada', $user->getHandle());
        $this->assertSame('<a href="tg://user?id=7">Ada Lovelace</a>', $user->mention());
        $this->assertStringContainsString('(tg://user?id=7)', $user->mention('Markdown'));

        $user->sendMessage('hi');
        $this->assertSame(['chat_id' => 7, 'text' => 'hi'], $this->http->lastPayload());
    }

    public function testAUserWithoutAUsernameFallsBackToTheirName(): void
    {
        /** @var User $user */
        $user = $this->telegram->getFactory()->part(User::class, ['id' => 8, 'is_bot' => false, 'first_name' => 'Grace']);

        $this->assertSame('Grace', $user->getHandle());
    }

    public function testACallbackQueryIsAnswered(): void
    {
        /** @var CallbackQuery $query */
        $query = $this->telegram->getFactory()->part(CallbackQuery::class, [
            'id' => 'q-1',
            'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
            'chat_instance' => 'ci',
            'data' => 'deploy:yes',
            'message' => ['message_id' => 5, 'date' => 1700000000, 'chat' => ['id' => -100, 'type' => 'group']],
        ]);

        $query->answer('shipping', showAlert: true);

        $this->assertSame('answerCallbackQuery', $this->http->lastMethod());
        $this->assertSame(['callback_query_id' => 'q-1', 'text' => 'shipping', 'show_alert' => true], $this->http->lastPayload());

        $query->editMessage('shipped');

        $this->assertSame(
            ['chat_id' => -100, 'message_id' => 5, 'text' => 'shipped'],
            $this->http->lastPayload(),
            'Editing works through the message the button belongs to.',
        );
    }

    public function testAnInlineCallbackQueryEditsByInlineMessageId(): void
    {
        /** @var CallbackQuery $query */
        $query = $this->telegram->getFactory()->part(CallbackQuery::class, [
            'id' => 'q-2',
            'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
            'chat_instance' => 'ci',
            'inline_message_id' => 'inline-9',
        ]);

        $query->editMessage('done');

        $this->assertSame(['inline_message_id' => 'inline-9', 'text' => 'done'], $this->http->lastPayload());
    }

    public function testAJoinRequestIsApprovedOrDeclined(): void
    {
        /** @var ChatJoinRequest $request */
        $request = $this->telegram->getFactory()->part(ChatJoinRequest::class, [
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'from' => ['id' => 7, 'is_bot' => false, 'first_name' => 'Ada'],
            'user_chat_id' => 7,
            'date' => 1700000000,
        ]);

        $request->approve();
        $this->assertSame('approveChatJoinRequest', $this->http->lastMethod());
        $this->assertSame(['chat_id' => -100, 'user_id' => 7], $this->http->lastPayload());

        $request->decline();
        $this->assertSame('declineChatJoinRequest', $this->http->lastMethod());
    }

    public function testAFileKnowsItsUrlAndCanBeSaved(): void
    {
        /** @var File $file */
        $file = $this->telegram->getFactory()->part(File::class, [
            'file_id' => 'f-1',
            'file_unique_id' => 'u-1',
            'file_path' => 'photos/file_1.jpg',
        ]);

        $this->assertSame('https://api.telegram.org/file/botTEST:TOKEN/photos/file_1.jpg', $file->getUrl());
        $this->assertSame('file-bytes', await($file->download()));

        $target = sys_get_temp_dir() . '/telegramphp-' . bin2hex(random_bytes(4)) . '.jpg';

        try {
            $this->assertSame($target, await($file->save($target)));
            $this->assertStringEqualsFile($target, 'file-bytes');
        } finally {
            @unlink($target);
        }
    }

    public function testAFileWithoutAPathCannotBeDownloaded(): void
    {
        /** @var File $file */
        $file = $this->telegram->getFactory()->part(File::class, ['file_id' => 'f-1', 'file_unique_id' => 'u-1']);

        $this->expectException(\Telegram\Exceptions\TelegramException::class);

        $file->getUrl();
    }
}
