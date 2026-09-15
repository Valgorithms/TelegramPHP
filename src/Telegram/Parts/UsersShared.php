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
 * This object contains information about the users whose identifiers were shared with the bot
 * using a KeyboardButtonRequestUsers button.
 *
 * @property int                                                     $request_id Identifier of the request
 * @property \Discord\Helpers\Collection<\Telegram\Parts\SharedUser> $users Information about users shared with the bot
 *
 * @link https://core.telegram.org/bots/api#usersshared
 *
 * @since v10.3
 */
class UsersShared extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'request_id',
        'users',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'users' => 'Array of SharedUser',
    ];
}
