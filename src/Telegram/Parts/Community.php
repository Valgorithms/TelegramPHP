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
 * Represents a community (a group of chats).
 *
 * @property int    $id Unique identifier for this community. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property string $name Name of the community
 *
 * @link https://core.telegram.org/bots/api#community
 *
 * @since Bot API 10.3
 */
class Community extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'name',
    ];
}
