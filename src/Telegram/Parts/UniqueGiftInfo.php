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
 * Describes a service message about a unique gift that was sent or received.
 *
 * @property \Telegram\Parts\UniqueGift                                      $gift Information about the gift
 * @property string                                                          $origin Origin of the gift. Currently, either "upgrade" for gifts upgraded from regular gifts, "transfer" for gifts transferred from other users or channels, "resale" for gifts bought from other users, "gifted_upgrade" for upgrades purchased after the gift was sent, or "offer" for gifts bought or sold through gift purchase offers.
 * @property string|null                                                     $text Optional. Text of the message that was added to the gift
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. Special entities that appear in the text
 * @property bool|null                                                       $is_private Optional. True, if the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
 * @property string|null                                                     $last_resale_currency Optional. For gifts bought from other users, the currency in which the payment for the gift was done. Currently, one of "XTR" for Telegram Stars or "TON" for TON grams.
 * @property int|null                                                        $last_resale_amount Optional. For gifts bought from other users, the price paid for the gift in either Telegram Stars or nanograms
 * @property string|null                                                     $owned_gift_id Optional. Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
 * @property int|null                                                        $transfer_star_count Optional. Number of Telegram Stars that must be paid to transfer the gift; omitted if the bot cannot transfer the gift
 * @property \Carbon\CarbonImmutable|null                                    $next_transfer_date Optional. Point in time (Unix timestamp) when the gift can be transferred. If it is in the past, then the gift can be transferred now.
 *
 * @link https://core.telegram.org/bots/api#uniquegiftinfo
 *
 * @since v10.3
 */
class UniqueGiftInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'gift',
        'origin',
        'text',
        'entities',
        'is_private',
        'last_resale_currency',
        'last_resale_amount',
        'owned_gift_id',
        'transfer_star_count',
        'next_transfer_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gift'     => 'UniqueGift',
        'entities' => 'Array of MessageEntity',
    ];

    /** @var list<string> */
    protected array $dates = [
        'next_transfer_date',
    ];
}
