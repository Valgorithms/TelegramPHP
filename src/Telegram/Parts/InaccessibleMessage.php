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
 * This object describes a message that was deleted or is otherwise inaccessible to the bot.
 *
 * @property \Telegram\Parts\Chat    $chat Chat the message belonged to
 * @property int                     $message_id Unique message identifier inside the chat
 * @property \Carbon\CarbonImmutable $date Always 0. The field can be used to differentiate regular and inaccessible messages.
 *
 * @link https://core.telegram.org/bots/api#inaccessiblemessage
 *
 * @since v10.3
 */
class InaccessibleMessage extends MaybeInaccessibleMessage
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'message_id',
        'date',
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
