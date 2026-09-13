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
 * Describes a service message about a chat being joined by a user from a community.
 *
 * @property \Telegram\Parts\Community $community The community from which the chat was joined
 *
 * @link https://core.telegram.org/bots/api#communitychatjoined
 *
 * @since Bot API 10.3
 */
class CommunityChatJoined extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'community',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'community' => 'Community',
    ];
}
