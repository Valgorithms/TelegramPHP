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
 * Describes a transaction with a user.
 *
 * @property string                                                      $type Type of the transaction partner, always "user"
 * @property string                                                      $transaction_type Type of the transaction, currently one of "invoice_payment" for payments via invoices, "paid_media_payment" for payments for paid media, "gift_purchase" for gifts sent by the bot, "premium_purchase" for Telegram Premium subscriptions gifted by the bot, "business_account_transfer" for direct transfers from managed business accounts
 * @property \Telegram\Parts\User                                        $user Information about the user
 * @property \Telegram\Parts\AffiliateInfo|null                          $affiliate Optional. Information about the affiliate that received a commission via this transaction. Can be available only for "invoice_payment" and "paid_media_payment" transactions.
 * @property string|null                                                 $invoice_payload Optional. Bot-specified invoice payload. Can be available only for "invoice_payment" transactions.
 * @property int|null                                                    $subscription_period Optional. The duration of the paid subscription. Can be available only for "invoice_payment" transactions.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PaidMedia>|null $paid_media Optional. Information about the paid media bought by the user; for "paid_media_payment" transactions only
 * @property string|null                                                 $paid_media_payload Optional. Bot-specified paid media payload. Can be available only for "paid_media_payment" transactions.
 * @property \Telegram\Parts\Gift|null                                   $gift Optional. The gift sent to the user by the bot; for "gift_purchase" transactions only
 * @property int|null                                                    $premium_subscription_duration Optional. Number of months the gifted Telegram Premium subscription will be active for; for "premium_purchase" transactions only
 *
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 *
 * @since v10.3
 */
class TransactionPartnerUser extends TransactionPartner
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'transaction_type',
        'user',
        'affiliate',
        'invoice_payload',
        'subscription_period',
        'paid_media',
        'paid_media_payload',
        'gift',
        'premium_subscription_duration',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user'       => 'User',
        'affiliate'  => 'AffiliateInfo',
        'paid_media' => 'Array of PaidMedia',
        'gift'       => 'Gift',
    ];
}
