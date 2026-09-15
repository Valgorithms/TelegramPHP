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
 * This object represents a boost removed from a chat.
 *
 * @property \Telegram\Parts\Chat            $chat Chat which was boosted
 * @property string                          $boost_id Unique identifier of the boost
 * @property \Carbon\CarbonImmutable         $remove_date Point in time (Unix timestamp) when the boost was removed
 * @property \Telegram\Parts\ChatBoostSource $source Source of the removed boost
 *
 * @link https://core.telegram.org/bots/api#chatboostremoved
 *
 * @since v10.3
 */
class ChatBoostRemoved extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'boost_id',
        'remove_date',
        'source',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'   => 'Chat',
        'source' => 'ChatBoostSource',
    ];

    /** @var list<string> */
    protected array $dates = [
        'remove_date',
    ];
}
