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
 * This object contains basic information about a refunded payment.
 *
 * @property string      $currency Three-letter ISO 4217 currency code, or "XTR" for payments in Telegram Stars. Currently, always "XTR".
 * @property int         $total_amount Total refunded price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45, total_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 * @property string      $invoice_payload Bot-specified invoice payload
 * @property string      $telegram_payment_charge_id Telegram payment identifier
 * @property string|null $provider_payment_charge_id Optional. Provider payment identifier
 *
 * @link https://core.telegram.org/bots/api#refundedpayment
 *
 * @since Bot API 10.3
 */
class RefundedPayment extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'currency',
        'total_amount',
        'invoice_payload',
        'telegram_payment_charge_id',
        'provider_payment_charge_id',
    ];
}
