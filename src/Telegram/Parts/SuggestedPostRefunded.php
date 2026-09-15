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
 * Describes a service message about a payment refund for a suggested post.
 *
 * @property \Telegram\Parts\Message|null $suggested_post_message Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property string                       $reason Reason for the refund. Currently, one of "post_deleted" if the post was deleted within 24 hours of being posted or removed from scheduled messages without being posted, or "payment_refunded" if the payer refunded their payment.
 *
 * @link https://core.telegram.org/bots/api#suggestedpostrefunded
 *
 * @since v10.3
 */
class SuggestedPostRefunded extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'suggested_post_message',
        'reason',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'suggested_post_message' => 'Message',
    ];
}
