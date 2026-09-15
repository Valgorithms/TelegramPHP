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
 * This object represents a message about the completion of a giveaway with public winners.
 *
 * @property \Telegram\Parts\Chat                              $chat The chat that created the giveaway
 * @property int                                               $giveaway_message_id Identifier of the message with the giveaway in the chat
 * @property \Carbon\CarbonImmutable                           $winners_selection_date Point in time (Unix timestamp) when winners of the giveaway were selected
 * @property int                                               $winner_count Total number of winners in the giveaway
 * @property \Discord\Helpers\Collection<\Telegram\Parts\User> $winners List of up to 100 winners of the giveaway
 * @property int|null                                          $additional_chat_count Optional. The number of other chats the user had to join in order to be eligible for the giveaway
 * @property int|null                                          $prize_star_count Optional. The number of Telegram Stars that were split between giveaway winners; for Telegram Star giveaways only
 * @property int|null                                          $premium_subscription_month_count Optional. The number of months the Telegram Premium subscription won from the giveaway will be active for; for Telegram Premium giveaways only
 * @property int|null                                          $unclaimed_prize_count Optional. Number of undistributed prizes
 * @property bool|null                                         $only_new_members Optional. True, if only users who had joined the chats after the giveaway started were eligible to win
 * @property bool|null                                         $was_refunded Optional. True, if the giveaway was canceled because the payment for it was refunded
 * @property string|null                                       $prize_description Optional. Description of additional giveaway prize
 *
 * @link https://core.telegram.org/bots/api#giveawaywinners
 *
 * @since v10.3
 */
class GiveawayWinners extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'giveaway_message_id',
        'winners_selection_date',
        'winner_count',
        'winners',
        'additional_chat_count',
        'prize_star_count',
        'premium_subscription_month_count',
        'unclaimed_prize_count',
        'only_new_members',
        'was_refunded',
        'prize_description',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'    => 'Chat',
        'winners' => 'Array of User',
    ];

    /** @var list<string> */
    protected array $dates = [
        'winners_selection_date',
    ];
}
