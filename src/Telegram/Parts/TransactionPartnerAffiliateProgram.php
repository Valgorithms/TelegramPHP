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
 * Describes the affiliate program that issued the affiliate commission received via this
 * transaction.
 *
 * @property string                    $type Type of the transaction partner, always "affiliate_program"
 * @property \Telegram\Parts\User|null $sponsor_user Optional. Information about the bot that sponsored the affiliate program
 * @property int                       $commission_per_mille The number of Telegram Stars received by the bot for each 1000 Telegram Stars received by the affiliate program sponsor from referred users
 *
 * @link https://core.telegram.org/bots/api#transactionpartneraffiliateprogram
 *
 * @since v10.3
 */
class TransactionPartnerAffiliateProgram extends TransactionPartner
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'sponsor_user',
        'commission_per_mille',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sponsor_user' => 'User',
    ];
}
