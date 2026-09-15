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
 * This object describes a unique gift that was upgraded from a regular gift.
 *
 * @property string                                $gift_id Identifier of the regular gift from which the gift was upgraded
 * @property string                                $base_name Human-readable name of the regular gift from which this unique gift was upgraded
 * @property string                                $name Unique name of the gift. This name can be used in https://t.me/nft/... links and story areas.
 * @property int                                   $number Unique number of the upgraded gift among gifts upgraded from the same regular gift
 * @property \Telegram\Parts\UniqueGiftModel       $model Model of the gift
 * @property \Telegram\Parts\UniqueGiftSymbol      $symbol Symbol of the gift
 * @property \Telegram\Parts\UniqueGiftBackdrop    $backdrop Backdrop of the gift
 * @property bool|null                             $is_premium Optional. True, if the original regular gift was exclusively purchaseable by Telegram Premium subscribers
 * @property bool|null                             $is_burned Optional. True, if the gift was used to craft another gift and isn't available anymore
 * @property bool|null                             $is_from_blockchain Optional. True, if the gift is assigned from the TON blockchain and can't be resold or transferred in Telegram
 * @property \Telegram\Parts\UniqueGiftColors|null $colors Optional. The color scheme that can be used by the gift's owner for the chat's name, replies to messages and link previews; for business account gifts and gifts that are currently on sale only
 * @property \Telegram\Parts\Chat|null             $publisher_chat Optional. Information about the chat that published the gift
 *
 * @link https://core.telegram.org/bots/api#uniquegift
 *
 * @since v10.3
 */
class UniqueGift extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'gift_id',
        'base_name',
        'name',
        'number',
        'model',
        'symbol',
        'backdrop',
        'is_premium',
        'is_burned',
        'is_from_blockchain',
        'colors',
        'publisher_chat',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'model'          => 'UniqueGiftModel',
        'symbol'         => 'UniqueGiftSymbol',
        'backdrop'       => 'UniqueGiftBackdrop',
        'colors'         => 'UniqueGiftColors',
        'publisher_chat' => 'Chat',
    ];
}
