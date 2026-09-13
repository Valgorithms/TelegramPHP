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
 * This object represents a service message about a user boosting a chat.
 *
 * @property int $boost_count Number of boosts added by the user
 *
 * @link https://core.telegram.org/bots/api#chatboostadded
 *
 * @since Bot API 10.3
 */
class ChatBoostAdded extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'boost_count',
    ];
}
