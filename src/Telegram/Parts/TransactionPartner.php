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
 * This object describes the source of a transaction, or its recipient for outgoing transactions.
 * Currently, it can be one of
 * - TransactionPartnerUser
 * - TransactionPartnerChat
 * - TransactionPartnerAffiliateProgram
 * - TransactionPartnerFragment
 * - TransactionPartnerTelegramAds
 * - TransactionPartnerTelegramApi
 * - TransactionPartnerOther
 *
 * One of: TransactionPartnerUser, TransactionPartnerChat, TransactionPartnerAffiliateProgram, TransactionPartnerFragment, TransactionPartnerTelegramAds, TransactionPartnerTelegramApi, TransactionPartnerOther.
 *
 * @link https://core.telegram.org/bots/api#transactionpartner
 *
 * @since v10.3
 */
abstract class TransactionPartner extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'user'              => TransactionPartnerUser::class,
        'chat'              => TransactionPartnerChat::class,
        'affiliate_program' => TransactionPartnerAffiliateProgram::class,
        'fragment'          => TransactionPartnerFragment::class,
        'telegram_ads'      => TransactionPartnerTelegramAds::class,
        'telegram_api'      => TransactionPartnerTelegramApi::class,
        'other'             => TransactionPartnerOther::class,
    ];
}
