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
 * This object contains information about an incoming shipping query.
 *
 * @property string                          $id Unique query identifier
 * @property \Telegram\Parts\User            $from User who sent the query
 * @property string                          $invoice_payload Bot-specified invoice payload
 * @property \Telegram\Parts\ShippingAddress $shipping_address User specified shipping address
 *
 * @link https://core.telegram.org/bots/api#shippingquery
 *
 * @since Bot API 10.3
 */
class ShippingQuery extends Part
{
    use Concerns\ShippingQueryBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'from',
        'invoice_payload',
        'shipping_address',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from'             => 'User',
        'shipping_address' => 'ShippingAddress',
    ];
}
