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

/**
 * Answering a button press.
 *
 * Telegram shows a progress indicator on the button until the query is answered,
 * so answer every callback query - even with nothing to say - and do it within a
 * few seconds.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait CallbackQueryBehaviour
{
    /**
     * Answers the query, optionally with a toast or an alert.
     *
     * @param array<string, mixed> $options Any other `answerCallbackQuery` field.
     *
     * @return PromiseInterface<bool>
     */
    public function answer(?string $text = null, bool $showAlert = false, array $options = []): PromiseInterface
    {
        return $this->telegram->request('answerCallbackQuery', array_merge([
            'callback_query_id' => $this->id,
            'text' => $text,
            'show_alert' => $showAlert,
        ], $options), ['Boolean']);
    }

    /**
     * Answers by sending the user to a URL - a `t.me` link, or the game the button
     * belongs to.
     *
     * @return PromiseInterface<bool>
     */
    public function answerWithUrl(string $url): PromiseInterface
    {
        return $this->telegram->request('answerCallbackQuery', [
            'callback_query_id' => $this->id,
            'url' => $url,
        ], ['Boolean']);
    }

    /**
     * Edits the message the pressed button belongs to.
     *
     * @param array<string, mixed> $options Any other `editMessageText` field.
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     */
    public function editMessage(string $text, array $options = []): PromiseInterface
    {
        $payload = $this->inline_message_id !== null
            ? ['inline_message_id' => $this->inline_message_id]
            : ['chat_id' => $this->message?->chat?->id, 'message_id' => $this->message?->message_id];

        return $this->telegram->request('editMessageText', array_merge($payload, ['text' => $text], $options), ['Message', 'Boolean']);
    }
}
