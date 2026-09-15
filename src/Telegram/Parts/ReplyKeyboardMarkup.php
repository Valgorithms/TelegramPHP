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
 * This object represents a custom keyboard with reply options (see Introduction to bots for
 * details and examples). Not supported in channels and for messages sent on behalf of a business
 * account.
 *
 * @property \Discord\Helpers\Collection<\Discord\Helpers\Collection<\Telegram\Parts\KeyboardButton>> $keyboard Array of button rows, each represented by an Array of KeyboardButton objects
 * @property bool|null                                                                                $is_persistent Optional. Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to False, in which case the custom keyboard can be hidden and opened with a keyboard icon.
 * @property bool|null                                                                                $resize_keyboard Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to False, in which case the custom keyboard is always of the same height as the app's standard keyboard.
 * @property bool|null                                                                                $one_time_keyboard Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again. Defaults to False.
 * @property string|null                                                                              $input_field_placeholder Optional. The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
 * @property bool|null                                                                                $selective Optional. Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message. Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
 * @property bool|null                                                                                $force_reply Optional. Pass True if the reply interface must be shown to the user, as if they had manually selected the bot's message and tapped 'Reply'
 *
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 *
 * @since v10.3
 */
class ReplyKeyboardMarkup extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'keyboard',
        'is_persistent',
        'resize_keyboard',
        'one_time_keyboard',
        'input_field_placeholder',
        'selective',
        'force_reply',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'keyboard' => 'Array of Array of KeyboardButton',
    ];
}
