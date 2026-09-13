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
 * The background is filled using the selected color.
 *
 * @property string $type Type of the background fill, always "solid"
 * @property int    $color The color of the background fill in the RGB24 format
 *
 * @link https://core.telegram.org/bots/api#backgroundfillsolid
 *
 * @since Bot API 10.3
 */
class BackgroundFillSolid extends BackgroundFill
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'color',
    ];
}
