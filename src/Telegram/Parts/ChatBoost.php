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
 * This object contains information about a chat boost.
 *
 * @property string                          $boost_id Unique identifier of the boost
 * @property \Carbon\CarbonImmutable         $add_date Point in time (Unix timestamp) when the chat was boosted
 * @property \Carbon\CarbonImmutable         $expiration_date Point in time (Unix timestamp) when the boost will automatically expire, unless the booster's Telegram Premium subscription is prolonged
 * @property \Telegram\Parts\ChatBoostSource $source Source of the added boost
 *
 * @link https://core.telegram.org/bots/api#chatboost
 *
 * @since v10.3
 */
class ChatBoost extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'boost_id',
        'add_date',
        'expiration_date',
        'source',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'source' => 'ChatBoostSource',
    ];

    /** @var list<string> */
    protected array $dates = [
        'add_date',
        'expiration_date',
    ];
}
