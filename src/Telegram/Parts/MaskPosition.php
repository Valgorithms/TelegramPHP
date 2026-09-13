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
 * This object describes the position on faces where a mask should be placed by default.
 *
 * @property string $point The part of the face relative to which the mask should be placed. One of "forehead", "eyes", "mouth", or "chin".
 * @property float  $x_shift Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
 * @property float  $y_shift Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
 * @property float  $scale Mask scaling coefficient. For example, 2.0 means double size.
 *
 * @link https://core.telegram.org/bots/api#maskposition
 *
 * @since Bot API 10.3
 */
class MaskPosition extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'point',
        'x_shift',
        'y_shift',
        'scale',
    ];
}
