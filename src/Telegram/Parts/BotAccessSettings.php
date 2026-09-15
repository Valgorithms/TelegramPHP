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
 * This object describes the access settings of a bot.
 *
 * @property bool                                                   $is_access_restricted True, if only selected users can access the bot. The bot's owner can always access it.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\User>|null $added_users Optional. The list of other users who have access to the bot if the access is restricted
 *
 * @link https://core.telegram.org/bots/api#botaccesssettings
 *
 * @since v10.3
 */
class BotAccessSettings extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'is_access_restricted',
        'added_users',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'added_users' => 'Array of User',
    ];
}
