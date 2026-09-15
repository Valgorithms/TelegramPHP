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
 * This object contains information about the color scheme for a user's name, message replies and
 * link previews based on a unique gift.
 *
 * @property string          $model_custom_emoji_id Custom emoji identifier of the unique gift's model
 * @property string          $symbol_custom_emoji_id Custom emoji identifier of the unique gift's symbol
 * @property int             $light_theme_main_color Main color used in light themes; RGB format
 * @property array<int, int> $light_theme_other_colors List of 1-3 additional colors used in light themes; RGB format
 * @property int             $dark_theme_main_color Main color used in dark themes; RGB format
 * @property array<int, int> $dark_theme_other_colors List of 1-3 additional colors used in dark themes; RGB format
 *
 * @link https://core.telegram.org/bots/api#uniquegiftcolors
 *
 * @since v10.3
 */
class UniqueGiftColors extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'model_custom_emoji_id',
        'symbol_custom_emoji_id',
        'light_theme_main_color',
        'light_theme_other_colors',
        'dark_theme_main_color',
        'dark_theme_other_colors',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'light_theme_other_colors' => 'Array of Integer',
        'dark_theme_other_colors'  => 'Array of Integer',
    ];
}
