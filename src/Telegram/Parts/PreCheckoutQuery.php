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
 * This object contains information about an incoming pre-checkout query.
 *
 * @property string                         $id Unique query identifier
 * @property \Telegram\Parts\User           $from User who sent the query
 * @property string                         $currency Three-letter ISO 4217 currency code, or "XTR" for payments in Telegram Stars
 * @property int                            $total_amount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 * @property string                         $invoice_payload Bot-specified invoice payload
 * @property string|null                    $shipping_option_id Optional. Identifier of the shipping option chosen by the user
 * @property \Telegram\Parts\OrderInfo|null $order_info Optional. Order information provided by the user
 *
 * @link https://core.telegram.org/bots/api#precheckoutquery
 *
 * @since Bot API 10.3
 */
class PreCheckoutQuery extends Part
{
    use Concerns\PreCheckoutQueryBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'from',
        'currency',
        'total_amount',
        'invoice_payload',
        'shipping_option_id',
        'order_info',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from'       => 'User',
        'order_info' => 'OrderInfo',
    ];
}
