<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts\Concerns;

use React\Promise\PromiseInterface;
use Telegram\Builders\InputFile;

/**
 * What you can do to a chat you are holding.
 *
 * Mixed into the generated {@see \Telegram\Parts\Chat} part (and, through
 * {@see ChatFullInfoBehaviour}, into the full variant), so the chat id is read
 * off the part instead of being passed back in.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait ChatBehaviour
{
    /**
     * Sends a message to this chat.
     *
     * @param array<string, mixed> $options Any other `sendMessage` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function sendMessage(string $text, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendMessage', array_merge([
            'chat_id' => $this->id,
            'text' => $text,
        ], $options), ['Message']);
    }

    /**
     * Sends a photo to this chat.
     *
     * @param array<string, mixed> $options Any other `sendPhoto` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function sendPhoto(InputFile|string $photo, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendPhoto', array_merge([
            'chat_id' => $this->id,
            'photo' => $photo,
        ], $options), ['Message']);
    }

    /**
     * Shows "typing...", "sending photo...", and the rest, for a few seconds.
     *
     * @return PromiseInterface<bool>
     */
    public function sendAction(string $action = 'typing'): PromiseInterface
    {
        return $this->telegram->request('sendChatAction', [
            'chat_id' => $this->id,
            'action' => $action,
        ], ['Boolean']);
    }

    /**
     * The full record for this chat, which carries far more than the stub an
     * update brings along.
     *
     * @return PromiseInterface<\Telegram\Parts\ChatFullInfo>
     */
    public function fetch(): PromiseInterface
    {
        return $this->telegram->request('getChat', ['chat_id' => $this->id], ['ChatFullInfo']);
    }

    /**
     * One member of this chat.
     *
     * @return PromiseInterface<\Telegram\Parts\ChatMember>
     */
    public function getMember(int $userId): PromiseInterface
    {
        return $this->telegram->request('getChatMember', [
            'chat_id' => $this->id,
            'user_id' => $userId,
        ], ['ChatMember']);
    }

    /**
     * How many members this chat has.
     *
     * @return PromiseInterface<int>
     */
    public function countMembers(): PromiseInterface
    {
        return $this->telegram->request('getChatMemberCount', ['chat_id' => $this->id], ['Integer']);
    }

    /**
     * Bans a user, optionally until a point in time.
     *
     * @param array<string, mixed> $options Any other `banChatMember` field.
     *
     * @return PromiseInterface<bool>
     */
    public function ban(int $userId, array $options = []): PromiseInterface
    {
        return $this->telegram->request('banChatMember', array_merge([
            'chat_id' => $this->id,
            'user_id' => $userId,
        ], $options), ['Boolean']);
    }

    /**
     * Lifts a ban.
     *
     * @return PromiseInterface<bool>
     */
    public function unban(int $userId, bool $onlyIfBanned = true): PromiseInterface
    {
        return $this->telegram->request('unbanChatMember', [
            'chat_id' => $this->id,
            'user_id' => $userId,
            'only_if_banned' => $onlyIfBanned,
        ], ['Boolean']);
    }

    /**
     * Leaves this chat.
     *
     * @return PromiseInterface<bool>
     */
    public function leave(): PromiseInterface
    {
        return $this->telegram->request('leaveChat', ['chat_id' => $this->id], ['Boolean']);
    }
}
