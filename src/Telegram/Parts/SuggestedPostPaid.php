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
 * Describes a service message about a successful payment for a suggested post.
 *
 * @property \Telegram\Parts\Message|null    $suggested_post_message Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property string                          $currency Currency in which the payment was made. Currently, one of "XTR" for Telegram Stars or "TON" for TON grams.
 * @property int|null                        $amount Optional. The amount of the currency that was received by the channel in nanograms; for payments in TON grams only
 * @property \Telegram\Parts\StarAmount|null $star_amount Optional. The amount of Telegram Stars that was received by the channel; for payments in Telegram Stars only
 *
 * @link https://core.telegram.org/bots/api#suggestedpostpaid
 *
 * @since v10.3
 */
class SuggestedPostPaid extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'suggested_post_message',
        'currency',
        'amount',
        'star_amount',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'suggested_post_message' => 'Message',
        'star_amount'            => 'StarAmount',
    ];
}
