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
 * This object represents a service message about the completion of a giveaway without public
 * winners.
 *
 * @property int                          $winner_count Number of winners in the giveaway
 * @property int|null                     $unclaimed_prize_count Optional. Number of undistributed prizes
 * @property \Telegram\Parts\Message|null $giveaway_message Optional. Message with the giveaway that was completed, if it wasn't deleted
 * @property bool|null                    $is_star_giveaway Optional. True, if the giveaway is a Telegram Star giveaway. Otherwise, currently, the giveaway is a Telegram Premium giveaway.
 *
 * @link https://core.telegram.org/bots/api#giveawaycompleted
 *
 * @since v10.3
 */
class GiveawayCompleted extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'winner_count',
        'unclaimed_prize_count',
        'giveaway_message',
        'is_star_giveaway',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'giveaway_message' => 'Message',
    ];
}
