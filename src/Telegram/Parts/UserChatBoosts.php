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
 * This object represents a list of boosts added to a chat by a user.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ChatBoost> $boosts The list of boosts added to the chat by the user
 *
 * @link https://core.telegram.org/bots/api#userchatboosts
 *
 * @since v10.3
 */
class UserChatBoosts extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'boosts',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'boosts' => 'Array of ChatBoost',
    ];
}
