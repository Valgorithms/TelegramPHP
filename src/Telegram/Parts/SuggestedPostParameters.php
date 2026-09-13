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
 * Contains parameters of a post that is being suggested by the bot.
 *
 * @property \Telegram\Parts\SuggestedPostPrice|null $price Optional. Proposed price for the post. If the field is omitted, then the post is unpaid.
 * @property \Carbon\CarbonImmutable|null            $send_date Optional. Proposed send date of the post. If specified, then the date must be between 300 second and 2678400 seconds (30 days) in the future. If the field is omitted, then the post can be published at any time within 30 days at the sole discretion of the user who approves it.
 *
 * @link https://core.telegram.org/bots/api#suggestedpostparameters
 *
 * @since Bot API 10.3
 */
class SuggestedPostParameters extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'price',
        'send_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'price' => 'SuggestedPostPrice',
    ];

    /** @var list<string> */
    protected array $dates = [
        'send_date',
    ];
}
