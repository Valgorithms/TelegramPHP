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
 * This object represents an inline button that switches the current user to inline mode in a
 * chosen chat, with an optional default inline query.
 *
 * @property string|null $query Optional. The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted.
 * @property bool|null   $allow_user_chats Optional. True, if private chats with users can be chosen
 * @property bool|null   $allow_bot_chats Optional. True, if private chats with bots can be chosen
 * @property bool|null   $allow_group_chats Optional. True, if group and supergroup chats can be chosen
 * @property bool|null   $allow_channel_chats Optional. True, if channel chats can be chosen
 *
 * @link https://core.telegram.org/bots/api#switchinlinequerychosenchat
 *
 * @since v10.3
 */
class SwitchInlineQueryChosenChat extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'query',
        'allow_user_chats',
        'allow_bot_chats',
        'allow_group_chats',
        'allow_channel_chats',
    ];
}
