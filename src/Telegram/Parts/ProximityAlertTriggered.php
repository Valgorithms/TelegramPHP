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
 * This object represents the content of a service message, sent whenever a user in the chat
 * triggers a proximity alert set by another user.
 *
 * @property \Telegram\Parts\User $traveler User that triggered the alert
 * @property \Telegram\Parts\User $watcher User that set the alert
 * @property int                  $distance The distance between the users
 *
 * @link https://core.telegram.org/bots/api#proximityalerttriggered
 *
 * @since v10.3
 */
class ProximityAlertTriggered extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'traveler',
        'watcher',
        'distance',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'traveler' => 'User',
        'watcher'  => 'User',
    ];
}
