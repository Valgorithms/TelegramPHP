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
 * This object represents a button to be shown above inline query results. You must use exactly one
 * of the optional fields.
 *
 * @property string                          $text Label text on the button
 * @property \Telegram\Parts\WebAppInfo|null $web_app Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to switch back to the inline mode using the method switchInlineQuery inside the Web App.
 * @property string|null                     $start_parameter Optional. Deep-linking parameter for the /start message sent to the bot when a user presses the button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed. Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultsbutton
 *
 * @since Bot API 10.3
 */
class InlineQueryResultsButton extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'web_app',
        'start_parameter',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'web_app' => 'WebAppInfo',
    ];
}
