<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Builders;

/**
 * Builds the `InlineKeyboardMarkup` attached under a message - the buttons that
 * stay with the message rather than replacing the user's keyboard.
 *
 * ```php
 * $telegram->sendMessage($chatId, 'Deploy?', reply_markup: InlineKeyboard::new()
 *     ->callback('Ship it', 'deploy:yes')
 *     ->callback('Hold', 'deploy:no')
 *     ->row()
 *     ->url('What changed', 'https://example.com/diff'));
 * ```
 *
 * Buttons land in the current row; {@see row()} starts the next one.
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class InlineKeyboard implements \JsonSerializable
{
    /** @var list<list<array<string, mixed>>> */
    private array $rows = [[]];

    public static function new(): self
    {
        return new self();
    }

    /** Starts a new row. A row that would be left empty is dropped on serialisation. */
    public function row(): self
    {
        $this->rows[] = [];

        return $this;
    }

    /**
     * Adds a button built by hand, for the fields the named helpers do not cover.
     *
     * @param array<string, mixed> $button
     */
    public function button(array $button): self
    {
        $this->rows[array_key_last($this->rows)][] = $button;

        return $this;
    }

    /** A button that sends `callback_data` back as a callback query. */
    public function callback(string $text, string $data): self
    {
        return $this->button(['text' => $text, 'callback_data' => $data]);
    }

    /** A button that opens a URL. */
    public function url(string $text, string $url): self
    {
        return $this->button(['text' => $text, 'url' => $url]);
    }

    /** A button that launches a Mini App. */
    public function webApp(string $text, string $url): self
    {
        return $this->button(['text' => $text, 'web_app' => ['url' => $url]]);
    }

    /** A button that logs the user in to your site through Telegram. */
    public function login(string $text, string $url, ?string $forwardText = null, ?string $botUsername = null, ?bool $requestWriteAccess = null): self
    {
        return $this->button(['text' => $text, 'login_url' => array_filter([
            'url' => $url,
            'forward_text' => $forwardText,
            'bot_username' => $botUsername,
            'request_write_access' => $requestWriteAccess,
        ], static fn ($value): bool => $value !== null)]);
    }

    /** A button that drops the bot's username and a query into a chat the user picks. */
    public function switchInline(string $text, string $query = '', bool $currentChat = false): self
    {
        return $this->button([
            'text' => $text,
            $currentChat ? 'switch_inline_query_current_chat' : 'switch_inline_query' => $query,
        ]);
    }

    /** A button that copies text to the user's clipboard. */
    public function copyText(string $text, string $copy): self
    {
        return $this->button(['text' => $text, 'copy_text' => ['text' => $copy]]);
    }

    /** A button that opens a game. One per message, and it must be the first button. */
    public function game(string $text): self
    {
        return $this->button(['text' => $text, 'callback_game' => new \stdClass()]);
    }

    /** The pay button for an invoice. One per message, and it must be the first button. */
    public function pay(string $text): self
    {
        return $this->button(['text' => $text, 'pay' => true]);
    }

    /**
     * @return array{inline_keyboard: list<list<array<string, mixed>>>}
     */
    public function jsonSerialize(): array
    {
        return ['inline_keyboard' => array_values(array_filter($this->rows, static fn (array $row): bool => $row !== []))];
    }
}
