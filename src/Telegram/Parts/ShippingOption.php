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
 * This object represents one shipping option.
 *
 * @property string                                                    $id Shipping option identifier
 * @property string                                                    $title Option title
 * @property \Discord\Helpers\Collection<\Telegram\Parts\LabeledPrice> $prices List of price portions
 *
 * @link https://core.telegram.org/bots/api#shippingoption
 *
 * @since v10.3
 */
class ShippingOption extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'title',
        'prices',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'prices' => 'Array of LabeledPrice',
    ];
}
