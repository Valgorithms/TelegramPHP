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
 * This object represents an animated emoji that displays a random value.
 *
 * @property string $emoji Emoji on which the dice throw animation is based
 * @property int    $value Value of the dice, 1-6 for "🎲", "🎯" and "🎳" base emoji, 1-5 for "🏀" and "⚽" base emoji, 1-64 for "🎰" base emoji
 *
 * @link https://core.telegram.org/bots/api#dice
 *
 * @since v10.3
 */
class Dice extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'emoji',
        'value',
    ];
}
