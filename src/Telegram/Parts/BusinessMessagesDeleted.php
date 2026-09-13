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
 * This object is received when messages are deleted from a connected business account.
 *
 * @property string               $business_connection_id Unique identifier of the business connection
 * @property \Telegram\Parts\Chat $chat Information about a chat in the business account. The bot may not have access to the chat or the corresponding user.
 * @property array<int, int>      $message_ids The list of identifiers of deleted messages in the chat of the business account
 *
 * @link https://core.telegram.org/bots/api#businessmessagesdeleted
 *
 * @since Bot API 10.3
 */
class BusinessMessagesDeleted extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'business_connection_id',
        'chat',
        'message_ids',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'        => 'Chat',
        'message_ids' => 'Array of Integer',
    ];
}
