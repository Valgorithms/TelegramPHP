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
 * Represents a location to which a chat is connected.
 *
 * @property \Telegram\Parts\Location $location The location to which the supergroup is connected. Can't be a live location.
 * @property string                   $address Location address; 1-64 characters, as defined by the chat owner
 *
 * @link https://core.telegram.org/bots/api#chatlocation
 *
 * @since v10.3
 */
class ChatLocation extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'location',
        'address',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'location' => 'Location',
    ];
}
