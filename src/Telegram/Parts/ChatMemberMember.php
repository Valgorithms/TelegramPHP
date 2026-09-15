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
 * Represents a chat member that has no additional privileges or restrictions.
 *
 * @property string                       $status The member's status in the chat, always "member"
 * @property string|null                  $tag Optional. Tag of the member
 * @property \Telegram\Parts\User         $user Information about the user
 * @property \Carbon\CarbonImmutable|null $until_date Optional. Date when the user's subscription will expire; Unix time
 *
 * @link https://core.telegram.org/bots/api#chatmembermember
 *
 * @since v10.3
 */
class ChatMemberMember extends ChatMember
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'status',
        'tag',
        'user',
        'until_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];

    /** @var list<string> */
    protected array $dates = [
        'until_date',
    ];
}
