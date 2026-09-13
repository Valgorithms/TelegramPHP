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
 * This object represents a shipping address.
 *
 * @property string $country_code Two-letter ISO 3166-1 alpha-2 country code
 * @property string $state State, if applicable
 * @property string $city City
 * @property string $street_line1 First line for the address
 * @property string $street_line2 Second line for the address
 * @property string $post_code Address post code
 *
 * @link https://core.telegram.org/bots/api#shippingaddress
 *
 * @since Bot API 10.3
 */
class ShippingAddress extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'country_code',
        'state',
        'city',
        'street_line1',
        'street_line2',
        'post_code',
    ];
}
