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
 * This object contains information about a user that was shared with the bot using a
 * KeyboardButtonRequestUsers button.
 *
 * @property int                                                         $user_id Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so 64-bit integers or double-precision float types are safe for storing these identifiers. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
 * @property string|null                                                 $first_name Optional. First name of the user, if the name was requested by the bot
 * @property string|null                                                 $last_name Optional. Last name of the user, if the name was requested by the bot
 * @property string|null                                                 $username Optional. Username of the user, if the username was requested by the bot
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null $photo Optional. Available sizes of the chat photo, if the photo was requested by the bot
 *
 * @link https://core.telegram.org/bots/api#shareduser
 *
 * @since v10.3
 */
class SharedUser extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'username',
        'photo',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo' => 'Array of PhotoSize',
    ];
}
