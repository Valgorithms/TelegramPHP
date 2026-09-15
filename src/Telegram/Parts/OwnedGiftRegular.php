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
 * Describes a regular gift owned by a user or a chat.
 *
 * @property string                                                          $type Type of the gift, always "regular"
 * @property \Telegram\Parts\Gift                                            $gift Information about the regular gift
 * @property string|null                                                     $owned_gift_id Optional. Unique identifier of the gift for the bot; for gifts received on behalf of business accounts only
 * @property \Telegram\Parts\User|null                                       $sender_user Optional. Sender of the gift if it is a known user
 * @property \Carbon\CarbonImmutable                                         $send_date Date the gift was sent in Unix time
 * @property string|null                                                     $text Optional. Text of the message that was added to the gift
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. Special entities that appear in the text
 * @property bool|null                                                       $is_private Optional. True, if the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
 * @property bool|null                                                       $is_saved Optional. True, if the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
 * @property bool|null                                                       $can_be_upgraded Optional. True, if the gift can be upgraded to a unique gift; for gifts received on behalf of business accounts only
 * @property bool|null                                                       $was_refunded Optional. True, if the gift was refunded and isn't available anymore
 * @property int|null                                                        $convert_star_count Optional. Number of Telegram Stars that can be claimed by the receiver instead of the gift; omitted if the gift cannot be converted to Telegram Stars; for gifts received on behalf of business accounts only
 * @property int|null                                                        $prepaid_upgrade_star_count Optional. Number of Telegram Stars that were paid for the ability to upgrade the gift
 * @property bool|null                                                       $is_upgrade_separate Optional. True, if the gift's upgrade was purchased after the gift was sent; for gifts received on behalf of business accounts only
 * @property int|null                                                        $unique_gift_number Optional. Unique number reserved for this gift when upgraded. See the number field in UniqueGift.
 *
 * @link https://core.telegram.org/bots/api#ownedgiftregular
 *
 * @since v10.3
 */
class OwnedGiftRegular extends OwnedGift
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
        'text',
        'entities',
        'is_private',
        'is_saved',
        'can_be_upgraded',
        'was_refunded',
        'convert_star_count',
        'prepaid_upgrade_star_count',
        'is_upgrade_separate',
        'unique_gift_number',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gift'        => 'Gift',
        'sender_user' => 'User',
        'entities'    => 'Array of MessageEntity',
    ];

    /** @var list<string> */
    protected array $dates = [
        'send_date',
    ];
}
