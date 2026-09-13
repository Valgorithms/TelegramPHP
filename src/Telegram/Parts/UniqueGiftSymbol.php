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
 * This object describes the symbol shown on the pattern of a unique gift.
 *
 * @property string                  $name Name of the symbol
 * @property \Telegram\Parts\Sticker $sticker The sticker that represents the unique gift
 * @property int                     $rarity_per_mille The number of unique gifts that receive this model for every 1000 gifts upgraded
 *
 * @link https://core.telegram.org/bots/api#uniquegiftsymbol
 *
 * @since Bot API 10.3
 */
class UniqueGiftSymbol extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'name',
        'sticker',
        'rarity_per_mille',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sticker' => 'Sticker',
    ];
}
