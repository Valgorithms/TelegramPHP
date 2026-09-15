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
 * Represents a location to be sent.
 *
 * @property string     $type Type of the media, must be location
 * @property float      $latitude Latitude of the location
 * @property float      $longitude Longitude of the location
 * @property float|null $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
 *
 * @link https://core.telegram.org/bots/api#inputmedialocation
 *
 * @since v10.3
 */
class InputMediaLocation extends InputPollMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'latitude',
        'longitude',
        'horizontal_accuracy',
    ];
}
