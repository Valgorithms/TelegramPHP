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
 * Represents a result of an inline query that was chosen by the user and sent to their chat
 * partner.
 * Note: It is necessary to enable inline feedback via @BotFather in order to receive these objects
 * in updates.
 *
 * @property string                        $result_id The unique identifier for the result that was chosen
 * @property \Telegram\Parts\User          $from The user that chose the result
 * @property \Telegram\Parts\Location|null $location Optional. Sender location, only for bots that require user location
 * @property string|null                   $inline_message_id Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
 * @property string                        $query The query that was used to obtain the result
 *
 * @link https://core.telegram.org/bots/api#choseninlineresult
 *
 * @since Bot API 10.3
 */
class ChosenInlineResult extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'result_id',
        'from',
        'location',
        'inline_message_id',
        'query',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from'     => 'User',
        'location' => 'Location',
    ];
}
