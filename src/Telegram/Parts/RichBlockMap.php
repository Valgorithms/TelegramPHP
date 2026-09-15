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
 * A block with a map, corresponding to the custom HTML tag <tg-map>.
 *
 * @property string                                $type Type of the block, always "map"
 * @property \Telegram\Parts\Location              $location Location of the center of the map
 * @property int                                   $zoom Map zoom level
 * @property int                                   $width Expected width of the map
 * @property int                                   $height Expected height of the map
 * @property \Telegram\Parts\RichBlockCaption|null $caption Optional. Caption of the block
 *
 * @link https://core.telegram.org/bots/api#richblockmap
 *
 * @since v10.3
 */
class RichBlockMap extends RichBlock
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
