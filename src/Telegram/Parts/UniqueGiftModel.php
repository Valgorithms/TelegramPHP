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
 * This object describes the model of a unique gift.
 *
 * @property string                  $name Name of the model
 * @property \Telegram\Parts\Sticker $sticker The sticker that represents the unique gift
 * @property int                     $rarity_per_mille The number of unique gifts that receive this model for every 1000 gift upgrades. Always 0 for crafted gifts.
 * @property string|null             $rarity Optional. Rarity of the model if it is a crafted model. Currently, can be "uncommon", "rare", "epic", or "legendary".
 *
 * @link https://core.telegram.org/bots/api#uniquegiftmodel
 *
 * @since v10.3
 */
class UniqueGiftModel extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'name',
        'sticker',
        'rarity_per_mille',
        'rarity',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sticker' => 'Sticker',
    ];
}
