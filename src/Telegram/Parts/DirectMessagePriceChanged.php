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
 * Describes a service message about a change in the price of direct messages sent to a channel
 * chat.
 *
 * @property bool     $are_direct_messages_enabled True, if direct messages are enabled for the channel chat; False otherwise
 * @property int|null $direct_message_star_count Optional. The new number of Telegram Stars that must be paid by users for each direct message sent to the channel. Does not apply to users who have been exempted by administrators. Defaults to 0.
 *
 * @link https://core.telegram.org/bots/api#directmessagepricechanged
 *
 * @since v10.3
 */
class DirectMessagePriceChanged extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'are_direct_messages_enabled',
        'direct_message_star_count',
    ];
}
