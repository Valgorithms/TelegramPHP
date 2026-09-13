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
 * This object represents a point on the map.
 *
 * @property float      $latitude Latitude as defined by the sender
 * @property float      $longitude Longitude as defined by the sender
 * @property float|null $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
 * @property int|null   $live_period Optional. Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
 * @property int|null   $heading Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
 * @property int|null   $proximity_alert_radius Optional. The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
 *
 * @link https://core.telegram.org/bots/api#location
 *
 * @since Bot API 10.3
 */
class Location extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'latitude',
        'longitude',
        'horizontal_accuracy',
        'live_period',
        'heading',
        'proximity_alert_radius',
    ];
}
