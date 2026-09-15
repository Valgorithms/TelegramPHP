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
 * Describes the birthdate of a user.
 *
 * @property int      $day Day of the user's birth; 1-31
 * @property int      $month Month of the user's birth; 1-12
 * @property int|null $year Optional. Year of the user's birth
 *
 * @link https://core.telegram.org/bots/api#birthdate
 *
 * @since v10.3
 */
class Birthdate extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'day',
        'month',
        'year',
    ];
}
