<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * This object contains information about the creation, token update, or owner update of a bot that
 * is managed by the current bot.
 *
 * @property \Telegram\Parts\User $user User that created the bot
 * @property \Telegram\Parts\User $bot Information about the bot. Token of the bot can be fetched using the method getManagedBotToken.
 *
 * @link https://core.telegram.org/bots/api#managedbotupdated
 *
 * @since Bot API 10.3
 */
class ManagedBotUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'user',
        'bot',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
        'bot'  => 'User',
    ];
}
