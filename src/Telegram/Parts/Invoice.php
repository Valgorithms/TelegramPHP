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
 * This object contains basic information about an invoice.
 *
 * @property string $title Product name
 * @property string $description Product description
 * @property string $start_parameter Unique bot deep-linking parameter that can be used to generate this invoice
 * @property string $currency Three-letter ISO 4217 currency code, or "XTR" for payments in Telegram Stars
 * @property int    $total_amount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 *
 * @link https://core.telegram.org/bots/api#invoice
 *
 * @since v10.3
 */
class Invoice extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'title',
        'description',
        'start_parameter',
        'currency',
        'total_amount',
    ];
}
