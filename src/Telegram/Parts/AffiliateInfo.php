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
 * Contains information about the affiliate that received a commission via this transaction.
 *
 * @property \Telegram\Parts\User|null $affiliate_user Optional. The bot or the user that received an affiliate commission if it was received by a bot or a user
 * @property \Telegram\Parts\Chat|null $affiliate_chat Optional. The chat that received an affiliate commission if it was received by a chat
 * @property int                       $commission_per_mille The number of Telegram Stars received by the affiliate for each 1000 Telegram Stars received by the bot from referred users
 * @property int                       $amount Integer amount of Telegram Stars received by the affiliate from the transaction, rounded to 0; can be negative for refunds
 * @property int|null                  $nanostar_amount Optional. The number of 1/1000000000 shares of Telegram Stars received by the affiliate; from -999999999 to 999999999; can be negative for refunds
 *
 * @link https://core.telegram.org/bots/api#affiliateinfo
 *
 * @since Bot API 10.3
 */
class AffiliateInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'affiliate_user',
        'affiliate_chat',
        'commission_per_mille',
        'amount',
        'nanostar_amount',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'affiliate_user' => 'User',
        'affiliate_chat' => 'Chat',
    ];
}
