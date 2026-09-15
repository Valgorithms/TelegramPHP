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
 * Describes the price of a suggested post.
 *
 * @property string $currency Currency in which the post will be paid. Currently, must be one of "XTR" for Telegram Stars or "TON" for TON grams.
 * @property int    $amount The amount of the currency that will be paid for the post in the smallest units of the currency, i.e. Telegram Stars or nanograms. Currently, price in Telegram Stars must be between 5 and 100000, and price in nanograms must be between 10000000 and 10000000000000.
 *
 * @link https://core.telegram.org/bots/api#suggestedpostprice
 *
 * @since v10.3
 */
class SuggestedPostPrice extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'currency',
        'amount',
    ];
}
