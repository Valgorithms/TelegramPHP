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
 * This object contains basic information about a successful payment. Note that if the buyer
 * initiates a chargeback with the relevant payment provider following this transaction, the funds
 * may be debited from your balance. This is outside of Telegram's control.
 *
 * @property string                         $currency Three-letter ISO 4217 currency code, or "XTR" for payments in Telegram Stars
 * @property int                            $total_amount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 * @property string                         $invoice_payload Bot-specified invoice payload
 * @property \Carbon\CarbonImmutable|null   $subscription_expiration_date Optional. Expiration date of the subscription, in Unix time; for recurring payments only
 * @property bool|null                      $is_recurring Optional. True, if the payment is a recurring payment for a subscription
 * @property bool|null                      $is_first_recurring Optional. True, if the payment is the first payment for a subscription
 * @property string|null                    $shipping_option_id Optional. Identifier of the shipping option chosen by the user
 * @property \Telegram\Parts\OrderInfo|null $order_info Optional. Order information provided by the user
 * @property string                         $telegram_payment_charge_id Telegram payment identifier
 * @property string                         $provider_payment_charge_id Provider payment identifier
 *
 * @link https://core.telegram.org/bots/api#successfulpayment
 *
 * @since Bot API 10.3
 */
class SuccessfulPayment extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'currency',
        'total_amount',
        'invoice_payload',
        'subscription_expiration_date',
        'is_recurring',
        'is_first_recurring',
        'shipping_option_id',
        'order_info',
        'telegram_payment_charge_id',
        'provider_payment_charge_id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'order_info' => 'OrderInfo',
    ];

    /** @var list<string> */
    protected array $dates = [
        'subscription_expiration_date',
    ];
}
