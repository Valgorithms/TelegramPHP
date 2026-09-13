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
 * Represents a chat member that has some additional privileges.
 *
 * @property string               $status The member's status in the chat, always "administrator"
 * @property \Telegram\Parts\User $user Information about the user
 * @property bool                 $can_be_edited True, if the bot is allowed to edit administrator privileges of that user
 * @property bool                 $is_anonymous True, if the user's presence in the chat is hidden
 * @property bool                 $can_manage_chat True, if the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages, ignore slow mode, and send messages to the chat without paying Telegram Stars. Implied by any other administrator privilege.
 * @property bool                 $can_delete_messages True, if the administrator can delete messages of other users
 * @property bool                 $can_manage_video_chats True, if the administrator can manage video chats
 * @property bool                 $can_restrict_members True, if the administrator can restrict, ban or unban chat members, or access supergroup statistics
 * @property bool                 $can_promote_members True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
 * @property bool                 $can_change_info True, if the user is allowed to change the chat title, photo and other settings
 * @property bool                 $can_invite_users True, if the user is allowed to invite new users to the chat
 * @property bool                 $can_post_stories True, if the administrator can post stories to the chat
 * @property bool                 $can_edit_stories True, if the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive
 * @property bool                 $can_delete_stories True, if the administrator can delete stories posted by other users
 * @property bool|null            $can_post_messages Optional. True, if the administrator can post messages in the channel, approve suggested posts, or access channel statistics; for channels only
 * @property bool|null            $can_edit_messages Optional. True, if the administrator can edit messages of other users and can pin messages; for channels only
 * @property bool|null            $can_pin_messages Optional. True, if the user is allowed to pin messages; for groups and supergroups only
 * @property bool|null            $can_manage_topics Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; for supergroups only
 * @property bool|null            $can_manage_direct_messages Optional. True, if the administrator can manage direct messages of the channel and decline suggested posts; for channels only
 * @property bool|null            $can_manage_tags Optional. True, if the administrator can edit the tags of regular members; for groups and supergroups only
 * @property bool                 $can_send_welcome_messages True, if the administrator can manage chat welcome messages or directly send them in the case of bots
 * @property string|null          $custom_title Optional. Custom title for this user
 *
 * @link https://core.telegram.org/bots/api#chatmemberadministrator
 *
 * @since Bot API 10.3
 */
class ChatMemberAdministrator extends ChatMember
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'status',
        'user',
        'can_be_edited',
        'is_anonymous',
        'can_manage_chat',
        'can_delete_messages',
        'can_manage_video_chats',
        'can_restrict_members',
        'can_promote_members',
        'can_change_info',
        'can_invite_users',
        'can_post_stories',
        'can_edit_stories',
        'can_delete_stories',
        'can_post_messages',
        'can_edit_messages',
        'can_pin_messages',
        'can_manage_topics',
        'can_manage_direct_messages',
        'can_manage_tags',
        'can_send_welcome_messages',
        'custom_title',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
