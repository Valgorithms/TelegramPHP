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
 * This object describes an update about a user stopping message generation.
 *
 * @property \Telegram\Parts\Chat $chat Chat in which the message is generated
 * @property int|null             $message_thread_id Optional. Unique identifier of the message thread in which the message is generated
 * @property int                  $draft_id Unique identifier of the message draft which was stopped
 *
 * @link https://core.telegram.org/bots/api#messagegenerationstopped
 *
 * @since v10.3
 */
class MessageGenerationStopped extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'message_thread_id',
        'draft_id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat' => 'Chat',
    ];
}
