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
 * This object contains information about the bot that was created to be managed by the current
 * bot.
 *
 * @property \Telegram\Parts\User $bot Information about the bot. The bot's token can be fetched using the method getManagedBotToken.
 *
 * @link https://core.telegram.org/bots/api#managedbotcreated
 *
 * @since v10.3
 */
class ManagedBotCreated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'bot',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'bot' => 'User',
    ];
}
