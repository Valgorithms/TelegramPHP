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
 * Describes the position of a clickable area within a story.
 *
 * @property float $x_percentage The abscissa of the area's center, as a percentage of the media width
 * @property float $y_percentage The ordinate of the area's center, as a percentage of the media height
 * @property float $width_percentage The width of the area's rectangle, as a percentage of the media width
 * @property float $height_percentage The height of the area's rectangle, as a percentage of the media height
 * @property float $rotation_angle The clockwise rotation angle of the rectangle, in degrees; 0-360
 * @property float $corner_radius_percentage The radius of the rectangle corner rounding, as a percentage of the media width
 *
 * @link https://core.telegram.org/bots/api#storyareaposition
 *
 * @since v10.3
 */
class StoryAreaPosition extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'x_percentage',
        'y_percentage',
        'width_percentage',
        'height_percentage',
        'rotation_angle',
        'corner_radius_percentage',
    ];
}
