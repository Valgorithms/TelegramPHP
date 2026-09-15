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
 * This object represents changes in the status of a chat member.
 *
 * @property \Telegram\Parts\Chat                $chat Chat the user belongs to
 * @property \Telegram\Parts\User                $from Performer of the action, which resulted in the change
 * @property \Carbon\CarbonImmutable             $date Date the change was done in Unix time
 * @property \Telegram\Parts\ChatMember          $old_chat_member Previous information about the chat member
 * @property \Telegram\Parts\ChatMember          $new_chat_member New information about the chat member
 * @property \Telegram\Parts\ChatInviteLink|null $invite_link Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only
 * @property bool|null                           $via_join_request Optional. True, if the user joined the chat after sending a direct join request without using an invite link and being approved by an administrator
 * @property bool|null                           $via_chat_folder_invite_link Optional. True, if the user joined the chat via a chat folder invite link
 *
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 *
 * @since v10.3
 */
class ChatMemberUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'from',
        'date',
        'old_chat_member',
        'new_chat_member',
        'invite_link',
        'via_join_request',
        'via_chat_folder_invite_link',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'            => 'Chat',
        'from'            => 'User',
        'old_chat_member' => 'ChatMember',
        'new_chat_member' => 'ChatMember',
        'invite_link'     => 'ChatInviteLink',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
