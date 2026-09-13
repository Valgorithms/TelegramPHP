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
 * Describes a unique gift received and owned by a user or a chat.
 *
 * @property string                       $type Type of the gift, always "unique"
 * @property \Telegram\Parts\UniqueGift   $gift Information about the unique gift
 * @property string|null                  $owned_gift_id Optional. Unique identifier of the received gift for the bot; for gifts received on behalf of business accounts only
 * @property \Telegram\Parts\User|null    $sender_user Optional. Sender of the gift if it is a known user
 * @property \Carbon\CarbonImmutable      $send_date Date the gift was sent in Unix time
 * @property bool|null                    $is_saved Optional. True, if the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
 * @property bool|null                    $can_be_transferred Optional. True, if the gift can be transferred to another owner; for gifts received on behalf of business accounts only
 * @property int|null                     $transfer_star_count Optional. Number of Telegram Stars that must be paid to transfer the gift; omitted if the bot cannot transfer the gift
 * @property \Carbon\CarbonImmutable|null $next_transfer_date Optional. Point in time (Unix timestamp) when the gift can be transferred. If it is in the past, then the gift can be transferred now.
 *
 * @link https://core.telegram.org/bots/api#ownedgiftunique
 *
 * @since Bot API 10.3
 */
class OwnedGiftUnique extends OwnedGift
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'gift',
        'owned_gift_id',
        'sender_user',
        'send_date',
        'is_saved',
        'can_be_transferred',
        'transfer_star_count',
        'next_transfer_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gift'        => 'UniqueGift',
        'sender_user' => 'User',
    ];

    /** @var list<string> */
    protected array $dates = [
        'send_date',
        'next_transfer_date',
    ];
}
