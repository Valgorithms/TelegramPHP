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
 * Represents a reaction added to a message along with the number of times it was added.
 *
 * @property \Telegram\Parts\ReactionType $type Type of the reaction
 * @property int                          $total_count Number of times the reaction was added
 *
 * @link https://core.telegram.org/bots/api#reactioncount
 *
 * @since v10.3
 */
class ReactionCount extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'type',
        'total_count',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'type' => 'ReactionType',
    ];
}
