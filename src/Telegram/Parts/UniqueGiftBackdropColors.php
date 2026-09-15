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
 * This object describes the colors of the backdrop of a unique gift.
 *
 * @property int $center_color The color in the center of the backdrop in RGB format
 * @property int $edge_color The color on the edges of the backdrop in RGB format
 * @property int $symbol_color The color to be applied to the symbol in RGB format
 * @property int $text_color The color for the text on the backdrop in RGB format
 *
 * @link https://core.telegram.org/bots/api#uniquegiftbackdropcolors
 *
 * @since v10.3
 */
class UniqueGiftBackdropColors extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'center_color',
        'edge_color',
        'symbol_color',
        'text_color',
    ];
}
