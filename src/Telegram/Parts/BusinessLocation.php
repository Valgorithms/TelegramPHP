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
 * Contains information about the location of a Telegram Business account.
 *
 * @property string                        $address Address of the business
 * @property \Telegram\Parts\Location|null $location Optional. Location of the business
 *
 * @link https://core.telegram.org/bots/api#businesslocation
 *
 * @since v10.3
 */
class BusinessLocation extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'address',
        'location',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'location' => 'Location',
    ];
}
