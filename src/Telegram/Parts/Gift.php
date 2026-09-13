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
 * This object represents a gift that can be sent by the bot.
 *
 * @property string                              $id Unique identifier of the gift
 * @property \Telegram\Parts\Sticker             $sticker The sticker that represents the gift
 * @property int                                 $star_count The number of Telegram Stars that must be paid to send the sticker
 * @property int|null                            $upgrade_star_count Optional. The number of Telegram Stars that must be paid to upgrade the gift to a unique one
 * @property bool|null                           $is_premium Optional. True, if the gift can only be purchased by Telegram Premium subscribers
 * @property bool|null                           $has_colors Optional. True, if the gift can be used (after being upgraded) to customize a user's appearance
 * @property int|null                            $total_count Optional. The total number of gifts of this type that can be sent by all users; for limited gifts only
 * @property int|null                            $remaining_count Optional. The number of remaining gifts of this type that can be sent by all users; for limited gifts only
 * @property int|null                            $personal_total_count Optional. The total number of gifts of this type that can be sent by the bot; for limited gifts only
 * @property int|null                            $personal_remaining_count Optional. The number of remaining gifts of this type that can be sent by the bot; for limited gifts only
 * @property \Telegram\Parts\GiftBackground|null $background Optional. Background of the gift
 * @property int|null                            $unique_gift_variant_count Optional. The total number of different unique gifts that can be obtained by upgrading the gift
 * @property \Telegram\Parts\Chat|null           $publisher_chat Optional. Information about the chat that published the gift
 *
 * @link https://core.telegram.org/bots/api#gift
 *
 * @since Bot API 10.3
 */
class Gift extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'sticker',
        'star_count',
        'upgrade_star_count',
        'is_premium',
        'has_colors',
        'total_count',
        'remaining_count',
        'personal_total_count',
        'personal_remaining_count',
        'background',
        'unique_gift_variant_count',
        'publisher_chat',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sticker'        => 'Sticker',
        'background'     => 'GiftBackground',
        'publisher_chat' => 'Chat',
    ];
}
