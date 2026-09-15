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
 * Describes the opening hours of a business.
 *
 * @property string                                                                    $time_zone_name Unique name of the time zone for which the opening hours are defined
 * @property \Discord\Helpers\Collection<\Telegram\Parts\BusinessOpeningHoursInterval> $opening_hours List of time intervals describing business opening hours
 *
 * @link https://core.telegram.org/bots/api#businessopeninghours
 *
 * @since v10.3
 */
class BusinessOpeningHours extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'time_zone_name',
        'opening_hours',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'opening_hours' => 'Array of BusinessOpeningHoursInterval',
    ];
}
