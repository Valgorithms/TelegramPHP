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
 * Describes a service message about a regular gift that was sent or received.
 *
 * @property \Telegram\Parts\Gift                                            $gift Information about the gift
 * @property string|null                                                     $owned_gift_id Optional. Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
 * @property int|null                                                        $convert_star_count Optional. Number of Telegram Stars that can be claimed by the receiver by converting the gift; omitted if conversion to Telegram Stars is impossible
 * @property int|null                                                        $prepaid_upgrade_star_count Optional. Number of Telegram Stars that were prepaid for the ability to upgrade the gift
 * @property bool|null                                                       $is_upgrade_separate Optional. True, if the gift's upgrade was purchased after the gift was sent
 * @property bool|null                                                       $can_be_upgraded Optional. True, if the gift can be upgraded to a unique gift
 * @property string|null                                                     $text Optional. Text of the message that was added to the gift
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. Special entities that appear in the text
 * @property bool|null                                                       $is_private Optional. True, if the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
 * @property int|null                                                        $unique_gift_number Optional. Unique number reserved for this gift when upgraded. See the number field in UniqueGift.
 *
 * @link https://core.telegram.org/bots/api#giftinfo
 *
 * @since v10.3
 */
class GiftInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'gift',
        'owned_gift_id',
        'convert_star_count',
        'prepaid_upgrade_star_count',
        'is_upgrade_separate',
        'can_be_upgraded',
        'text',
        'entities',
        'is_private',
        'unique_gift_number',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'gift'     => 'Gift',
        'entities' => 'Array of MessageEntity',
    ];
}
