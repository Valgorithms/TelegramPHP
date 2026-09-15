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
 * This object contains information about a chat that was shared with the bot using a
 * KeyboardButtonRequestChat button.
 *
 * @property int                                                         $request_id Identifier of the request
 * @property int                                                         $chat_id Identifier of the shared chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the chat and could be unable to use this identifier, unless the chat is already known to the bot by some other means.
 * @property string|null                                                 $title Optional. Title of the chat, if the title was requested by the bot
 * @property string|null                                                 $username Optional. Username of the chat, if the username was requested by the bot and available
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null $photo Optional. Available sizes of the chat photo, if the photo was requested by the bot
 *
 * @link https://core.telegram.org/bots/api#chatshared
 *
 * @since v10.3
 */
class ChatShared extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'request_id',
        'chat_id',
        'title',
        'username',
        'photo',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo' => 'Array of PhotoSize',
    ];
}
