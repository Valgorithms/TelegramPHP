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
 * This object represents one button of the reply keyboard. At most one of the fields other than
 * text, icon_custom_emoji_id, and style must be used to specify the type of the button. For simple
 * text buttons, String can be used instead of this object to specify the button text.
 *
 * @property string                                               $text Text of the button. If none of the fields other than text, icon_custom_emoji_id, and style are used, it will be sent as a message when the button is pressed.
 * @property string|null                                          $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown before the text of the button. Can only be used by bots that purchased additional usernames on Fragment or in the messages directly sent by the bot to private, group and supergroup chats if the owner of the bot has a Telegram Premium subscription.
 * @property string|null                                          $style Optional. Style of the button. Must be one of "danger" (red), "success" (green) or "primary" (blue). If omitted, then an app-specific style is used.
 * @property \Telegram\Parts\KeyboardButtonRequestUsers|null      $request_users Optional. If specified, pressing the button will open a list of suitable users. Identifiers of selected users will be sent to the bot in a "users_shared" service message. Available in private chats only.
 * @property \Telegram\Parts\KeyboardButtonRequestChat|null       $request_chat Optional. If specified, pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot in a "chat_shared" service message. Available in private chats only.
 * @property \Telegram\Parts\KeyboardButtonRequestManagedBot|null $request_managed_bot Optional. If specified, pressing the button will ask the user to create and share a bot that will be managed by the current bot. Available for bots that enabled management of other bots in the @BotFather Mini App. Available in private chats only.
 * @property bool|null                                            $request_contact Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
 * @property bool|null                                            $request_location Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only.
 * @property \Telegram\Parts\KeyboardButtonPollType|null          $request_poll Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
 * @property \Telegram\Parts\WebAppInfo|null                      $web_app Optional. If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a "web_app_data" service message. Available in private chats only.
 *
 * @link https://core.telegram.org/bots/api#keyboardbutton
 *
 * @since Bot API 10.3
 */
class KeyboardButton extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'icon_custom_emoji_id',
        'style',
        'request_users',
        'request_chat',
        'request_managed_bot',
        'request_contact',
        'request_location',
        'request_poll',
        'web_app',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'request_users'       => 'KeyboardButtonRequestUsers',
        'request_chat'        => 'KeyboardButtonRequestChat',
        'request_managed_bot' => 'KeyboardButtonRequestManagedBot',
        'request_poll'        => 'KeyboardButtonPollType',
        'web_app'             => 'WebAppInfo',
    ];
}
