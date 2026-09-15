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
 * The background is a gradient fill.
 *
 * @property string $type Type of the background fill, always "gradient"
 * @property int    $top_color Top color of the gradient in the RGB24 format
 * @property int    $bottom_color Bottom color of the gradient in the RGB24 format
 * @property int    $rotation_angle Clockwise rotation angle of the background fill in degrees; 0-359
 *
 * @link https://core.telegram.org/bots/api#backgroundfillgradient
 *
 * @since v10.3
 */
class BackgroundFillGradient extends BackgroundFill
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'top_color',
        'bottom_color',
        'rotation_angle',
    ];
}
