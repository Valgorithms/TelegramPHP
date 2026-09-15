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
 * This object represents a story.
 *
 * @property \Telegram\Parts\Chat $chat Chat that posted the story
 * @property int                  $id Unique identifier for the story in the chat
 *
 * @link https://core.telegram.org/bots/api#story
 *
 * @since v10.3
 */
class Story extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat' => 'Chat',
    ];
}
