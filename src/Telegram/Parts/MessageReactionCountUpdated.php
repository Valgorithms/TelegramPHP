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
 * This object represents reaction changes on a message with anonymous reactions.
 *
 * @property \Telegram\Parts\Chat                                       $chat The chat containing the message
 * @property int                                                        $message_id Unique message identifier inside the chat
 * @property \Carbon\CarbonImmutable                                    $date Date of the change in Unix time
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ReactionCount> $reactions List of reactions that are present on the message
 *
 * @link https://core.telegram.org/bots/api#messagereactioncountupdated
 *
 * @since v10.3
 */
class MessageReactionCountUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'message_id',
        'date',
        'reactions',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'      => 'Chat',
        'reactions' => 'Array of ReactionCount',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
