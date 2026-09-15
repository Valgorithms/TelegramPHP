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
 * A block with a map, corresponding to the custom HTML tag <tg-map>. The map's width and height
 * must not exceed 10000 in total. The width and height ratio must be at most 20.
 *
 * @property string                                $type Type of the block, always "map"
 * @property \Telegram\Parts\Location              $location Location of the center of the map
 * @property int|null                              $zoom Optional. Map zoom level; 0-24
 * @property int|null                              $width Optional. Map width; 0-10000
 * @property int|null                              $height Optional. Map height; 0-10000
 * @property \Telegram\Parts\RichBlockCaption|null $caption Optional. Caption of the block
 *
 * @link https://core.telegram.org/bots/api#inputrichblockmap
 *
 * @since v10.3
 */
class InputRichBlockMap extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'location',
        'zoom',
        'width',
        'height',
        'caption',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'location' => 'Location',
        'caption'  => 'RichBlockCaption',
    ];
}
