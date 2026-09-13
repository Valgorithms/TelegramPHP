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
 * Conveniences for a user part: how to name them, and how to write to them.
 *
 * A bot can only message a user who has started a conversation with it, so
 * {@see sendMessage()} rejects with a `403` when they have not.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait UserBehaviour
{
    /** First and last name, joined - the name Telegram shows. */
    public function getFullName(): string
    {
        return trim($this->first_name . ' ' . ($this->last_name ?? ''));
    }

    /** `@username` when they have one, their display name otherwise. */
    public function getHandle(): string
    {
        return $this->username !== null ? '@' . $this->username : $this->getFullName();
    }

    /**
     * A Markdown or HTML mention that links to this user, which works even when
     * they have no username.
     */
    public function mention(string $parseMode = 'HTML'): string
    {
        $name = $this->getFullName();

        return strtoupper($parseMode) === 'HTML'
            ? '<a href="tg://user?id=' . $this->id . '">' . htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE) . '</a>'
            : '[' . preg_replace('/([\\_*\[\]()~`>#+\-=|{}.!])/', '\\$1', $name) . '](tg://user?id=' . $this->id . ')';
    }

    /**
     * Messages this user directly.
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
     * This user's profile photos.
     *
     * @return PromiseInterface<\Telegram\Parts\UserProfilePhotos>
     */
    public function getProfilePhotos(?int $offset = null, ?int $limit = null): PromiseInterface
    {
        return $this->telegram->request('getUserProfilePhotos', [
            'user_id' => $this->id,
            'offset' => $offset,
            'limit' => $limit,
        ], ['UserProfilePhotos']);
    }
}
