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
 * The background is a freeform gradient that rotates after every message in the chat.
 *
 * @property string          $type Type of the background fill, always "freeform_gradient"
 * @property array<int, int> $colors A list of the 3 or 4 base colors that are used to generate the freeform gradient in the RGB24 format
 *
 * @link https://core.telegram.org/bots/api#backgroundfillfreeformgradient
 *
 * @since Bot API 10.3
 */
class BackgroundFillFreeformGradient extends BackgroundFill
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'colors',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'colors' => 'Array of Integer',
    ];
}
