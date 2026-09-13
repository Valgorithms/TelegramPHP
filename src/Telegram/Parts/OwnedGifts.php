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
 * Contains the list of gifts received and owned by a user or a chat.
 *
 * @property int                                                    $total_count The total number of gifts owned by the user or the chat
 * @property \Discord\Helpers\Collection<\Telegram\Parts\OwnedGift> $gifts The list of gifts
 * @property string|null                                            $next_offset Optional. Offset for the next request. If empty, then there are no more results.
 *
 * @link https://core.telegram.org/bots/api#ownedgifts
 *
 * @since Bot API 10.3
 */
class OwnedGifts extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'total_count',
        'gifts',
        'next_offset',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gifts' => 'Array of OwnedGift',
    ];
}
