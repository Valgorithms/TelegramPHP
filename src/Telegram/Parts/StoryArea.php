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
 * Describes a clickable area on a story media.
 *
 * @property \Telegram\Parts\StoryAreaPosition $position Position of the area
 * @property \Telegram\Parts\StoryAreaType     $type Type of the area
 *
 * @link https://core.telegram.org/bots/api#storyarea
 *
 * @since v10.3
 */
class StoryArea extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'position',
        'type',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'position' => 'StoryAreaPosition',
        'type'     => 'StoryAreaType',
    ];
}
