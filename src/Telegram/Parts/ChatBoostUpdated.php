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
 * This object represents a boost added to a chat or changed.
 *
 * @property \Telegram\Parts\Chat      $chat Chat which was boosted
 * @property \Telegram\Parts\ChatBoost $boost Information about the chat boost
 *
 * @link https://core.telegram.org/bots/api#chatboostupdated
 *
 * @since v10.3
 */
class ChatBoostUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'boost',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'  => 'Chat',
        'boost' => 'ChatBoost',
    ];
}
