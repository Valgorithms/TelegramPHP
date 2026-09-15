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
 * The message was originally sent on behalf of a chat to a group chat.
 *
 * @property string                  $type Type of the message origin, always "chat"
 * @property \Carbon\CarbonImmutable $date Date the message was sent originally in Unix time
 * @property \Telegram\Parts\Chat    $sender_chat Chat that sent the message originally
 * @property string|null             $author_signature Optional. For messages originally sent by an anonymous chat administrator, original message author signature
 *
 * @link https://core.telegram.org/bots/api#messageoriginchat
 *
 * @since v10.3
 */
class MessageOriginChat extends MessageOrigin
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'date',
        'sender_chat',
        'author_signature',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sender_chat' => 'Chat',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
