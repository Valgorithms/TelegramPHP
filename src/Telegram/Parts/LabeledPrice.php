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
 * This object represents a portion of the price for goods or services.
 *
 * @property string $label Portion label
 * @property int    $amount Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 *
 * @link https://core.telegram.org/bots/api#labeledprice
 *
 * @since Bot API 10.3
 */
class LabeledPrice extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'label',
        'amount',
    ];
}
