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
 * This object represents information about an order.
 *
 * @property string|null                          $name Optional. User name
 * @property string|null                          $phone_number Optional. User's phone number
 * @property string|null                          $email Optional. User email
 * @property \Telegram\Parts\ShippingAddress|null $shipping_address Optional. User shipping address
 *
 * @link https://core.telegram.org/bots/api#orderinfo
 *
 * @since Bot API 10.3
 */
class OrderInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'name',
        'phone_number',
        'email',
        'shipping_address',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'shipping_address' => 'ShippingAddress',
    ];
}
