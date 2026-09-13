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
 *
 *
 * @property int         $receiver_user_id Identifier of the user who will receive the message. It is not guaranteed that the user will receive the message, especially if they are offline. See here for more details.
 * @property string|null $callback_query_id Optional. Identifier of the callback query which triggered the message, if any
 * @property bool|null   $replace_callback_query_message Optional. Pass True if the ephemeral message must be shown in place of the original message. Must be False for callback queries from ephemeral messages, which must be edited using regular editEphemeralMessage... methods.
 *
 * @link https://core.telegram.org/bots/api#ephemeralmessageparameters
 *
 * @since Bot API 10.3
 */
class EphemeralMessageParameters extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'receiver_user_id',
        'callback_query_id',
        'replace_callback_query_message',
    ];
}
