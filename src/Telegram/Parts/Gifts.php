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
 * This object represent a list of gifts.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\Gift> $gifts The list of gifts
 *
 * @link https://core.telegram.org/bots/api#gifts
 *
 * @since v10.3
 */
class Gifts extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'gifts',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gifts' => 'Array of Gift',
    ];
}
