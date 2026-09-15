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
 * This object represents an incoming callback query from a callback button in an inline keyboard.
 * If the button that originated the query was attached to a message sent by the bot, the field
 * message will be present. If the button was attached to a message sent via the bot (in inline
 * mode), the field inline_message_id will be present. Exactly one of the fields data or
 * game_short_name will be present.
 *
 * @property string                                        $id Unique identifier for this query
 * @property \Telegram\Parts\User                          $from Sender
 * @property \Telegram\Parts\MaybeInaccessibleMessage|null $message Optional. Message sent by the bot with the callback button that originated the query
 * @property string|null                                   $inline_message_id Optional. Identifier of the message sent via the bot in inline mode, that originated the query
 * @property string                                        $chat_instance Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
 * @property string|null                                   $data Optional. Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
 * @property string|null                                   $game_short_name Optional. Short name of a Game to be returned, serves as the unique identifier for the game
 *
 * @link https://core.telegram.org/bots/api#callbackquery
 *
 * @since v10.3
 */
class CallbackQuery extends Part
{
    use Concerns\CallbackQueryBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'from',
        'message',
        'inline_message_id',
        'chat_instance',
        'data',
        'game_short_name',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from'    => 'User',
        'message' => 'MaybeInaccessibleMessage',
    ];
}
