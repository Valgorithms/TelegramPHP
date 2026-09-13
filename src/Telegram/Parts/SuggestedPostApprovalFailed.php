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
 * Describes a service message about the failed approval of a suggested post. Currently, only
 * caused by insufficient user funds at the time of approval.
 *
 * @property \Telegram\Parts\Message|null       $suggested_post_message Optional. Message containing the suggested post whose approval has failed. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property \Telegram\Parts\SuggestedPostPrice $price Expected price of the post
 *
 * @link https://core.telegram.org/bots/api#suggestedpostapprovalfailed
 *
 * @since Bot API 10.3
 */
class SuggestedPostApprovalFailed extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'suggested_post_message',
        'price',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'suggested_post_message' => 'Message',
        'price'                  => 'SuggestedPostPrice',
    ];
}
