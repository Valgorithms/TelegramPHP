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
 * Describes a service message about the approval of a suggested post.
 *
 * @property \Telegram\Parts\Message|null            $suggested_post_message Optional. Message containing the suggested post. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property \Telegram\Parts\SuggestedPostPrice|null $price Optional. Amount paid for the post
 * @property \Carbon\CarbonImmutable                 $send_date Date when the post will be published
 *
 * @link https://core.telegram.org/bots/api#suggestedpostapproved
 *
 * @since v10.3
 */
class SuggestedPostApproved extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'suggested_post_message',
        'price',
        'send_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'suggested_post_message' => 'Message',
        'price'                  => 'SuggestedPostPrice',
    ];

    /** @var list<string> */
    protected array $dates = [
        'send_date',
    ];
}
