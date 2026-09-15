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
 * This object represents one row of the high scores table for a game.
 *
 * @property int                  $position Position in high score table for the game
 * @property \Telegram\Parts\User $user User
 * @property int                  $score Score
 *
 * @link https://core.telegram.org/bots/api#gamehighscore
 *
 * @since v10.3
 */
class GameHighScore extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'position',
        'user',
        'score',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
