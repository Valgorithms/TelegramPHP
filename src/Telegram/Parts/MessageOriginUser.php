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
 * The message was originally sent by a known user.
 *
 * @property string                  $type Type of the message origin, always "user"
 * @property \Carbon\CarbonImmutable $date Date the message was sent originally in Unix time
 * @property \Telegram\Parts\User    $sender_user User that sent the message originally
 *
 * @link https://core.telegram.org/bots/api#messageoriginuser
 *
 * @since Bot API 10.3
 */
class MessageOriginUser extends MessageOrigin
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'date',
        'sender_user',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sender_user' => 'User',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
