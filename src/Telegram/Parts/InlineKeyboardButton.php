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
 * This object represents one button of an inline keyboard. Exactly one of the fields other than
 * text, icon_custom_emoji_id, and style must be used to specify the type of the button.
 *
 * @property string                                           $text Label text on the button
 * @property string|null                                      $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown before the text of the button. Can only be used by bots that purchased additional usernames on Fragment or in the messages directly sent by the bot to private, group and supergroup chats if the owner of the bot has a Telegram Premium subscription.
 * @property string|null                                      $style Optional. Style of the button. Must be one of "danger" (red), "success" (green) or "primary" (blue). If omitted, then an app-specific style is used.
 * @property string|null                                      $url Optional. HTTP or tg:// URL to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their identifier without using a username, if this is allowed by their privacy settings.
 * @property string|null                                      $callback_data Optional. Data to be sent in a callback query to the bot when the button is pressed, 1-64 bytes
 * @property \Telegram\Parts\WebAppInfo|null                  $web_app Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot. Not supported for messages sent on behalf of a business account.
 * @property \Telegram\Parts\LoginUrl|null                    $login_url Optional. An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget. Not supported for ephemeral messages.
 * @property string|null                                      $switch_inline_query Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. May be empty, in which case just the bot's username will be inserted. Not supported for messages sent in channel direct messages chats and on behalf of a business account.
 * @property string|null                                      $switch_inline_query_current_chat Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. May be empty, in which case only the bot's username will be inserted. This offers a quick way for the user to open your bot in inline mode in the same chat - good for selecting something from multiple options. Not supported in channels and for messages sent in channel direct messages chats and on behalf of a business account.
 * @property \Telegram\Parts\SwitchInlineQueryChosenChat|null $switch_inline_query_chosen_chat Optional. If set, pressing the button will prompt the user to select one of their chats of the specified type, open that chat and insert the bot's username and the specified inline query in the input field. Not supported for messages sent in channel direct messages chats and on behalf of a business account.
 * @property \Telegram\Parts\CopyTextButton|null              $copy_text Optional. Description of the button that copies the specified text to the clipboard
 * @property \Telegram\Parts\CallbackGame|null                $callback_game Optional. Description of the game that will be launched when the user presses the button. NOTE: This type of button must always be the first button in the first row.
 * @property bool|null                                        $pay Optional. Specify True, to send a Pay button. Substrings "⭐" and "XTR" in the buttons's text will be replaced with a Telegram Star icon. NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
 * @property \Telegram\Parts\DisabledButton|null              $disabled Optional. If set, then the button is disabled and does nothing
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 *
 * @since v10.3
 */
class InlineKeyboardButton extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'icon_custom_emoji_id',
        'style',
        'url',
        'callback_data',
        'web_app',
        'login_url',
        'switch_inline_query',
        'switch_inline_query_current_chat',
        'switch_inline_query_chosen_chat',
        'copy_text',
        'callback_game',
        'pay',
        'disabled',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'web_app'                         => 'WebAppInfo',
        'login_url'                       => 'LoginUrl',
        'switch_inline_query_chosen_chat' => 'SwitchInlineQueryChosenChat',
        'copy_text'                       => 'CopyTextButton',
        'callback_game'                   => 'CallbackGame',
        'disabled'                        => 'DisabledButton',
    ];
}
