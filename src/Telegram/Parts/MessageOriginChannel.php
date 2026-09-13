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
 * The message was originally sent to a channel chat.
 *
 * @property string                  $type Type of the message origin, always "channel"
 * @property \Carbon\CarbonImmutable $date Date the message was sent originally in Unix time
 * @property \Telegram\Parts\Chat    $chat Channel chat to which the message was originally sent
 * @property int                     $message_id Unique message identifier inside the chat
 * @property string|null             $author_signature Optional. Signature of the original post author
 *
 * @link https://core.telegram.org/bots/api#messageoriginchannel
 *
 * @since Bot API 10.3
 */
class MessageOriginChannel extends MessageOrigin
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'date',
        'chat',
        'message_id',
        'author_signature',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat' => 'Chat',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
