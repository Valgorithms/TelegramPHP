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
 * This object represents a message about a scheduled giveaway.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\Chat> $chats The list of chats which the user must join to participate in the giveaway
 * @property \Carbon\CarbonImmutable                           $winners_selection_date Point in time (Unix timestamp) when winners of the giveaway will be selected
 * @property int                                               $winner_count The number of users which are supposed to be selected as winners of the giveaway
 * @property bool|null                                         $only_new_members Optional. True, if only users who join the chats after the giveaway started should be eligible to win
 * @property bool|null                                         $has_public_winners Optional. True, if the list of giveaway winners will be visible to everyone
 * @property string|null                                       $prize_description Optional. Description of additional giveaway prize
 * @property array<int, string>|null                           $country_codes Optional. A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which eligible users for the giveaway must come. If empty, then all users can participate in the giveaway. Users with a phone number that was bought on Fragment can always participate in giveaways.
 * @property int|null                                          $prize_star_count Optional. The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
 * @property int|null                                          $premium_subscription_month_count Optional. The number of months the Telegram Premium subscription won from the giveaway will be active for; for Telegram Premium giveaways only
 *
 * @link https://core.telegram.org/bots/api#giveaway
 *
 * @since v10.3
 */
class Giveaway extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chats',
        'winners_selection_date',
        'winner_count',
        'only_new_members',
        'has_public_winners',
        'prize_description',
        'country_codes',
        'prize_star_count',
        'premium_subscription_month_count',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chats'         => 'Array of Chat',
        'country_codes' => 'Array of String',
    ];

    /** @var list<string> */
    protected array $dates = [
        'winners_selection_date',
    ];
}
