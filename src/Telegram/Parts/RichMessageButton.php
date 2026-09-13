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
 * This object represents a button in a RichMessage. Exactly one of the fields other than text and
 * style must be used to specify the type of the button.
 *
 * @property \Telegram\Parts\RichText                         $text Text of the button. May contain only plain text, RichTextCustomEmoji and RichTextDateTime entities.
 * @property string|null                                      $style Optional. Style of the button. Must be one of "danger", "success", "primary", or "link" (the button is shown as a regular link without borders). Apps may use theme-specific colors for the button background and text based on the style. The style "link" is allowed only for callback buttons.
 * @property string|null                                      $url Optional. HTTP or tg:// URL to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their identifier without using a username, if this is allowed by their privacy settings.
 * @property string|null                                      $callback_data Optional. Data to be sent in a callback query to the bot when the button is pressed, 1-64 bytes
 * @property \Telegram\Parts\WebAppInfo|null                  $web_app Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot. Not supported for messages sent on behalf of a business account.
 * @property \Telegram\Parts\LoginUrl|null                    $login_url Optional. An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget. Not supported for ephemeral messages.
 * @property string|null                                      $switch_inline_query Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. May be empty, in which case just the bot's username will be inserted. Not supported for messages sent in channel direct messages chats and on behalf of a business account.
 * @property string|null                                      $switch_inline_query_current_chat Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. May be empty, in which case only the bot's username will be inserted. Not supported in channels and for messages sent in channel direct messages chats and on behalf of a business account.
 * @property \Telegram\Parts\SwitchInlineQueryChosenChat|null $switch_inline_query_chosen_chat Optional. If set, pressing the button will prompt the user to select one of their chats of the specified type, open that chat and insert the bot's username and the specified inline query in the input field. Not supported for messages sent in channel direct messages chats and on behalf of a business account.
 * @property \Telegram\Parts\CopyTextButton|null              $copy_text Optional. A button that copies the specified text to the clipboard
 * @property \Telegram\Parts\DisabledButton|null              $disabled Optional. If set, then the button is disabled and does nothing
 *
 * @link https://core.telegram.org/bots/api#richmessagebutton
 *
 * @since Bot API 10.3
 */
class RichMessageButton extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'style',
        'url',
        'callback_data',
        'web_app',
        'login_url',
        'switch_inline_query',
        'switch_inline_query_current_chat',
        'switch_inline_query_chosen_chat',
        'copy_text',
        'disabled',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text'                            => 'RichText',
        'web_app'                         => 'WebAppInfo',
        'login_url'                       => 'LoginUrl',
        'switch_inline_query_chosen_chat' => 'SwitchInlineQueryChosenChat',
        'copy_text'                       => 'CopyTextButton',
        'disabled'                        => 'DisabledButton',
    ];
}
