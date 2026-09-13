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
 * This object describes the background of a gift.
 *
 * @property int $center_color Center color of the background in RGB format
 * @property int $edge_color Edge color of the background in RGB format
 * @property int $text_color Text color of the background in RGB format
 *
 * @link https://core.telegram.org/bots/api#giftbackground
 *
 * @since Bot API 10.3
 */
class GiftBackground extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'center_color',
        'edge_color',
        'text_color',
    ];
}
