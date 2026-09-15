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
 * Describes the connection of the bot with a business account.
 *
 * @property string                                 $id Unique identifier of the business connection
 * @property \Telegram\Parts\User                   $user Business account user that created the business connection
 * @property int                                    $user_chat_id Identifier of a private chat with the user who created the business connection. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property \Carbon\CarbonImmutable                $date Date the connection was established in Unix time
 * @property \Telegram\Parts\BusinessBotRights|null $rights Optional. Rights of the business bot
 * @property bool                                   $is_enabled True, if the connection is active
 *
 * @link https://core.telegram.org/bots/api#businessconnection
 *
 * @since v10.3
 */
class BusinessConnection extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'user',
        'user_chat_id',
        'date',
        'rights',
        'is_enabled',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user'   => 'User',
        'rights' => 'BusinessBotRights',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
