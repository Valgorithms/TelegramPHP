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
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 *
 * @property string               $status The member's status in the chat, always "left"
 * @property \Telegram\Parts\User $user Information about the user
 *
 * @link https://core.telegram.org/bots/api#chatmemberleft
 *
 * @since Bot API 10.3
 */
class ChatMemberLeft extends ChatMember
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'status',
        'user',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
