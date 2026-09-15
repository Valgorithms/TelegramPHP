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
 * Describes the physical address of a location.
 *
 * @property string      $country_code The two-letter ISO 3166-1 alpha-2 country code of the country where the location is located
 * @property string|null $state Optional. State of the location
 * @property string|null $city Optional. City of the location
 * @property string|null $street Optional. Street address of the location
 *
 * @link https://core.telegram.org/bots/api#locationaddress
 *
 * @since v10.3
 */
class LocationAddress extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'country_code',
        'state',
        'city',
        'street',
    ];
}
