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
 * Describes an amount of Telegram Stars.
 *
 * @property int      $amount Integer amount of Telegram Stars, rounded to 0; can be negative
 * @property int|null $nanostar_amount Optional. The number of 1/1000000000 shares of Telegram Stars; from -999999999 to 999999999; can be negative if and only if amount is non-positive
 *
 * @link https://core.telegram.org/bots/api#staramount
 *
 * @since v10.3
 */
class StarAmount extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'amount',
        'nanostar_amount',
    ];
}
