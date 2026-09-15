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
 * Describes a service message about a change in the price of paid messages within a chat.
 *
 * @property int $paid_message_star_count The new number of Telegram Stars that must be paid by non-administrator users of the supergroup chat for each sent message
 *
 * @link https://core.telegram.org/bots/api#paidmessagepricechanged
 *
 * @since v10.3
 */
class PaidMessagePriceChanged extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'paid_message_star_count',
    ];
}
