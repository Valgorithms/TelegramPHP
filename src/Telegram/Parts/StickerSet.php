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
 * This object represents a sticker set.
 *
 * @property string                                               $name Sticker set name
 * @property string                                               $title Sticker set title
 * @property string                                               $sticker_type Type of stickers in the set, currently one of "regular", "mask", "custom_emoji"
 * @property \Discord\Helpers\Collection<\Telegram\Parts\Sticker> $stickers List of all set stickers
 * @property \Telegram\Parts\PhotoSize|null                       $thumbnail Optional. Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
 *
 * @link https://core.telegram.org/bots/api#stickerset
 *
 * @since Bot API 10.3
 */
class StickerSet extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'name',
        'title',
        'sticker_type',
        'stickers',
        'thumbnail',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'stickers'  => 'Array of Sticker',
        'thumbnail' => 'PhotoSize',
    ];
}
