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
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @property \Discord\Helpers\Collection<\Discord\Helpers\Collection<\Telegram\Parts\InlineKeyboardButton>> $inline_keyboard Array of button rows, each represented by an Array of InlineKeyboardButton objects
 * @property bool|null                                                                                      $force_reply Optional. Pass True if the reply interface must be shown to the user, as if they had manually selected the bot's message and tapped 'Reply'. The value of the field can't be changed when the inline keyboard is edited.
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @since Bot API 10.3
 */
class InlineKeyboardMarkup extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'inline_keyboard',
        'force_reply',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'inline_keyboard' => 'Array of Array of InlineKeyboardButton',
    ];
}
