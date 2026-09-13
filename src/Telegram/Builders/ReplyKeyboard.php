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
 * Builds the `ReplyKeyboardMarkup` that replaces the user's keyboard with buttons
 * of your own.
 *
 * ```php
 * $telegram->sendMessage($chatId, 'Where are you?', reply_markup: ReplyKeyboard::new()
 *     ->requestLocation('Send my location')
 *     ->row()
 *     ->button('Skip')
 *     ->resize()
 *     ->oneTime());
 * ```
 *
 * {@see remove()} and {@see forceReply()} cover the other two reply markups, which
 * carry no buttons of their own.
 *
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class ReplyKeyboard implements \JsonSerializable
{
    /** @var list<list<array<string, mixed>>> */
    private array $rows = [[]];

    /** @var array<string, mixed> */
    private array $options = [];

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
     * Adds a button built by hand.
     *
     * @param array<string, mixed>|string $button A `KeyboardButton`, or just its text.
     */
    public function add(array|string $button): self
    {
        $this->rows[array_key_last($this->rows)][] = is_string($button) ? ['text' => $button] : $button;

        return $this;
    }

    /** A plain button; pressing it sends its text as a message. */
    public function button(string $text): self
    {
        return $this->add(['text' => $text]);
    }

    /** Asks the user to share their phone number. Private chats only. */
    public function requestContact(string $text): self
    {
        return $this->add(['text' => $text, 'request_contact' => true]);
    }

    /** Asks the user to share their location. Private chats only. */
    public function requestLocation(string $text): self
    {
        return $this->add(['text' => $text, 'request_location' => true]);
    }

    /** Asks the user to create a poll. Private chats only. */
    public function requestPoll(string $text, ?string $type = null): self
    {
        return $this->add(['text' => $text, 'request_poll' => $type === null ? new \stdClass() : ['type' => $type]]);
    }

    /** Opens a Mini App, whose data comes back as a service message. */
    public function webApp(string $text, string $url): self
    {
        return $this->add(['text' => $text, 'web_app' => ['url' => $url]]);
    }

    /**
     * Asks the user to pick users to share with the bot.
     *
     * @param array<string, mixed> $criteria Extra `KeyboardButtonRequestUsers` fields.
     */
    public function requestUsers(string $text, int $requestId, array $criteria = []): self
    {
        return $this->add(['text' => $text, 'request_users' => ['request_id' => $requestId] + $criteria]);
    }

    /**
     * Asks the user to pick a chat to share with the bot.
     *
     * @param array<string, mixed> $criteria Extra `KeyboardButtonRequestChat` fields.
     */
    public function requestChat(string $text, int $requestId, bool $chatIsChannel = false, array $criteria = []): self
    {
        return $this->add([
            'text' => $text,
            'request_chat' => ['request_id' => $requestId, 'chat_is_channel' => $chatIsChannel] + $criteria,
        ]);
    }

    /** Shrinks the keyboard to fit its buttons. */
    public function resize(bool $resize = true): self
    {
        $this->options['resize_keyboard'] = $resize;

        return $this;
    }

    /** Hides the keyboard once a button has been pressed. */
    public function oneTime(bool $oneTime = true): self
    {
        $this->options['one_time_keyboard'] = $oneTime;

        return $this;
    }

    /** Keeps the keyboard open until it is explicitly replaced or removed. */
    public function persistent(bool $persistent = true): self
    {
        $this->options['is_persistent'] = $persistent;

        return $this;
    }

    /** The placeholder shown in the input field while the keyboard is up. */
    public function placeholder(string $placeholder): self
    {
        $this->options['input_field_placeholder'] = $placeholder;

        return $this;
    }

    /** Shows the keyboard only to the users the message concerns. */
    public function selective(bool $selective = true): self
    {
        $this->options['selective'] = $selective;

        return $this;
    }

    /**
     * The `ReplyKeyboardRemove` markup, which takes a custom keyboard away.
     *
     * @return array<string, mixed>
     */
    public static function remove(bool $selective = false): array
    {
        return ['remove_keyboard' => true, 'selective' => $selective];
    }

    /**
     * The `ForceReply` markup, which puts the user straight into a reply.
     *
     * @return array<string, mixed>
     */
    public static function forceReply(?string $placeholder = null, bool $selective = false): array
    {
        return array_filter([
            'force_reply' => true,
            'input_field_placeholder' => $placeholder,
            'selective' => $selective,
        ], static fn ($value): bool => $value !== null);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return ['keyboard' => array_values(array_filter($this->rows, static fn (array $row): bool => $row !== []))] + $this->options;
    }
}
