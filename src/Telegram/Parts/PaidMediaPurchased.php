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
 * This object contains information about a paid media purchase.
 *
 * @property \Telegram\Parts\User $from User who purchased the media
 * @property string               $paid_media_payload Bot-specified paid media payload
 *
 * @link https://core.telegram.org/bots/api#paidmediapurchased
 *
 * @since v10.3
 */
class PaidMediaPurchased extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'from',
        'paid_media_payload',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'from' => 'User',
    ];
}
