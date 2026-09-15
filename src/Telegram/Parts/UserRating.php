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
 * This object describes the rating of a user based on their Telegram Star spendings.
 *
 * @property int      $level Current level of the user, indicating their reliability when purchasing digital goods and services. A higher level suggests a more trustworthy customer; a negative level is likely reason for concern.
 * @property int      $rating Numerical value of the user's rating; the higher the rating, the better
 * @property int      $current_level_rating The rating value required to get the current level
 * @property int|null $next_level_rating Optional. The rating value required to get to the next level; omitted if the maximum level was reached
 *
 * @link https://core.telegram.org/bots/api#userrating
 *
 * @since v10.3
 */
class UserRating extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'level',
        'rating',
        'current_level_rating',
        'next_level_rating',
    ];
}
