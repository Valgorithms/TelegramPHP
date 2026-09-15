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
 * The background is a wallpaper in the JPEG format.
 *
 * @property string                   $type Type of the background, always "wallpaper"
 * @property \Telegram\Parts\Document $document Document with the wallpaper
 * @property int                      $dark_theme_dimming Dimming of the background in dark themes, as a percentage; 0-100
 * @property bool|null                $is_blurred Optional. True, if the wallpaper is downscaled to fit in a 450x450 square and then box-blurred with radius 12
 * @property bool|null                $is_moving Optional. True, if the background moves slightly when the device is tilted
 *
 * @link https://core.telegram.org/bots/api#backgroundtypewallpaper
 *
 * @since v10.3
 */
class BackgroundTypeWallpaper extends BackgroundType
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'document',
        'dark_theme_dimming',
        'is_blurred',
        'is_moving',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'document' => 'Document',
    ];
}
