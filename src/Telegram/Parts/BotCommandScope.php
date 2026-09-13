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
 * This object represents the scope to which bot commands are applied. Currently, the following 7
 * scopes are supported:
 * - BotCommandScopeDefault
 * - BotCommandScopeAllPrivateChats
 * - BotCommandScopeAllGroupChats
 * - BotCommandScopeAllChatAdministrators
 * - BotCommandScopeChat
 * - BotCommandScopeChatAdministrators
 * - BotCommandScopeChatMember
 *
 * One of: BotCommandScopeDefault, BotCommandScopeAllPrivateChats, BotCommandScopeAllGroupChats, BotCommandScopeAllChatAdministrators, BotCommandScopeChat, BotCommandScopeChatAdministrators, BotCommandScopeChatMember.
 *
 * @link https://core.telegram.org/bots/api#botcommandscope
 *
 * @since Bot API 10.3
 */
abstract class BotCommandScope extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'default'                 => BotCommandScopeDefault::class,
        'all_private_chats'       => BotCommandScopeAllPrivateChats::class,
        'all_group_chats'         => BotCommandScopeAllGroupChats::class,
        'all_chat_administrators' => BotCommandScopeAllChatAdministrators::class,
        'chat'                    => BotCommandScopeChat::class,
        'chat_administrators'     => BotCommandScopeChatAdministrators::class,
        'chat_member'             => BotCommandScopeChatMember::class,
    ];
}
