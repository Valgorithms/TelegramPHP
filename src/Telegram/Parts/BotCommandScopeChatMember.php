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
 * Represents the scope of bot commands, covering a specific member of a group or supergroup chat.
 *
 * @property string     $type Scope type, must be chat_member
 * @property int|string $chat_id Unique identifier for the target chat or username of the target supergroup in the format @username. Channel direct messages chats and channel chats aren't supported.
 * @property int        $user_id Unique identifier of the target user
 *
 * @link https://core.telegram.org/bots/api#botcommandscopechatmember
 *
 * @since v10.3
 */
class BotCommandScopeChatMember extends BotCommandScope
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'chat_id',
        'user_id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat_id' => 'Integer',
    ];
}
