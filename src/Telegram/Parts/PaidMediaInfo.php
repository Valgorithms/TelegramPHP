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
 * Describes the paid media added to a message.
 *
 * @property int                                                    $star_count The number of Telegram Stars that must be paid to buy access to the media
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PaidMedia> $paid_media Information about the paid media
 *
 * @link https://core.telegram.org/bots/api#paidmediainfo
 *
 * @since v10.3
 */
class PaidMediaInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'star_count',
        'paid_media',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'paid_media' => 'Array of PaidMedia',
    ];
}
