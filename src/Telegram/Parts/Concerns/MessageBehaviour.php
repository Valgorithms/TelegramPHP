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
 * What you can do to a message you are holding.
 *
 * Mixed into the generated {@see \Telegram\Parts\Message} part, so the chat id,
 * message id, and business connection are read off the message instead of being
 * threaded through every call. Each method is a thin pass to the Bot API method
 * of the same job, and returns its promise.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait MessageBehaviour
{
    /** The id of the chat this message belongs to. */
    public function getChatId(): int|string|null
    {
        return $this->chat->id ?? null;
    }

    /**
     * Replies to this message.
     *
     * @param array<string, mixed> $options Any other `sendMessage` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function reply(string $text, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendMessage', array_merge([
            'chat_id' => $this->getChatId(),
            'text' => $text,
            'reply_parameters' => ['message_id' => $this->message_id],
            'business_connection_id' => $this->business_connection_id,
            'message_thread_id' => $this->message_thread_id,
        ], $options), ['Message']);
    }

    /**
     * Sends a message to this chat without quoting this one.
     *
     * @param array<string, mixed> $options Any other `sendMessage` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function say(string $text, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendMessage', array_merge([
            'chat_id' => $this->getChatId(),
            'text' => $text,
            'business_connection_id' => $this->business_connection_id,
            'message_thread_id' => $this->message_thread_id,
        ], $options), ['Message']);
    }

    /**
     * Replies with a photo.
     *
     * @param array<string, mixed> $options Any other `sendPhoto` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function replyWithPhoto(InputFile|string $photo, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendPhoto', array_merge([
            'chat_id' => $this->getChatId(),
            'photo' => $photo,
            'reply_parameters' => ['message_id' => $this->message_id],
            'business_connection_id' => $this->business_connection_id,
            'message_thread_id' => $this->message_thread_id,
        ], $options), ['Message']);
    }

    /**
     * Replies with a document.
     *
     * @param array<string, mixed> $options Any other `sendDocument` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function replyWithDocument(InputFile|string $document, array $options = []): PromiseInterface
    {
        return $this->telegram->request('sendDocument', array_merge([
            'chat_id' => $this->getChatId(),
            'document' => $document,
            'reply_parameters' => ['message_id' => $this->message_id],
            'business_connection_id' => $this->business_connection_id,
            'message_thread_id' => $this->message_thread_id,
        ], $options), ['Message']);
    }

    /**
     * Edits this message's text. Only messages the bot sent can be edited.
     *
     * @param array<string, mixed> $options Any other `editMessageText` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     */
    public function edit(string $text, array $options = []): PromiseInterface
    {
        return $this->telegram->request('editMessageText', array_merge([
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'text' => $text,
            'business_connection_id' => $this->business_connection_id,
        ], $options), ['Message', 'Boolean']);
    }

    /**
     * Edits this message's caption.
     *
     * @param array<string, mixed> $options Any other `editMessageCaption` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     */
    public function editCaption(?string $caption = null, array $options = []): PromiseInterface
    {
        return $this->telegram->request('editMessageCaption', array_merge([
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'caption' => $caption,
            'business_connection_id' => $this->business_connection_id,
        ], $options), ['Message', 'Boolean']);
    }

    /**
     * Replaces the buttons under this message.
     *
     * @param array<string, mixed>|\JsonSerializable|null $replyMarkup
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     */
    public function editReplyMarkup(array|\JsonSerializable|null $replyMarkup = null): PromiseInterface
    {
        return $this->telegram->request('editMessageReplyMarkup', [
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'reply_markup' => $replyMarkup,
            'business_connection_id' => $this->business_connection_id,
        ], ['Message', 'Boolean']);
    }

    /**
     * Deletes this message.
     *
     * @return PromiseInterface<bool>
     */
    public function delete(): PromiseInterface
    {
        return $this->telegram->request('deleteMessage', [
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
        ], ['Boolean']);
    }

    /**
     * Forwards this message to another chat.
     *
     * @param array<string, mixed> $options Any other `forwardMessage` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     */
    public function forward(int|string $chatId, array $options = []): PromiseInterface
    {
        return $this->telegram->request('forwardMessage', array_merge([
            'chat_id' => $chatId,
            'from_chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
        ], $options), ['Message']);
    }

    /**
     * Copies this message to another chat, without a link back to the original.
     *
     * @param array<string, mixed> $options Any other `copyMessage` field.
     *
     * @return PromiseInterface<\Telegram\Parts\MessageId>
     */
    public function copy(int|string $chatId, array $options = []): PromiseInterface
    {
        return $this->telegram->request('copyMessage', array_merge([
            'chat_id' => $chatId,
            'from_chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
        ], $options), ['MessageId']);
    }

    /**
     * Reacts to this message. Passing no emoji clears the bot's reaction.
     *
     * @param list<string>|string|null $emoji One or more reaction emoji.
     *
     * @return PromiseInterface<bool>
     */
    public function react(array|string|null $emoji = null, bool $isBig = false): PromiseInterface
    {
        $reactions = array_map(
            static fn (string $one): array => ['type' => 'emoji', 'emoji' => $one],
            $emoji === null ? [] : (array) $emoji,
        );

        return $this->telegram->request('setMessageReaction', [
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'reaction' => $reactions,
            'is_big' => $isBig,
        ], ['Boolean']);
    }

    /**
     * Pins this message in its chat.
     *
     * @return PromiseInterface<bool>
     */
    public function pin(bool $disableNotification = false): PromiseInterface
    {
        return $this->telegram->request('pinChatMessage', [
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'disable_notification' => $disableNotification,
            'business_connection_id' => $this->business_connection_id,
        ], ['Boolean']);
    }

    /**
     * Unpins this message.
     *
     * @return PromiseInterface<bool>
     */
    public function unpin(): PromiseInterface
    {
        return $this->telegram->request('unpinChatMessage', [
            'chat_id' => $this->getChatId(),
            'message_id' => $this->message_id,
            'business_connection_id' => $this->business_connection_id,
        ], ['Boolean']);
    }
}
