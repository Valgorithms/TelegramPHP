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
 * This object represents an incoming inline query. When the user sends an empty query, your bot
 * could return some default or trending results.
 *
 * @property string                        $id Unique identifier for this query
 * @property \Telegram\Parts\User          $from Sender
 * @property string                        $query Text of the query (up to 256 characters)
 * @property string                        $offset Offset of the results to be returned, can be controlled by the bot
 * @property string|null                   $chat_type Optional. Type of the chat from which the inline query was sent. Can be either "sender" for a private chat with the inline query sender, "private", "group", "supergroup", or "channel". The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat.
 * @property \Telegram\Parts\Location|null $location Optional. Sender location, only for bots that request user location
 *
 * @link https://core.telegram.org/bots/api#inlinequery
 *
 * @since v10.3
 */
class InlineQuery extends Part
{
    use Concerns\InlineQueryBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'from',
        'query',
        'offset',
        'chat_type',
        'location',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from'     => 'User',
        'location' => 'Location',
    ];
}
