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
 * Represents a chat member that is under certain restrictions in the chat. Supergroups only.
 *
 * @property string                  $status The member's status in the chat, always "restricted"
 * @property string|null             $tag Optional. Tag of the member
 * @property \Telegram\Parts\User    $user Information about the user
 * @property bool                    $is_member True, if the user is a member of the chat at the moment of the request
 * @property bool                    $can_send_messages True, if the user is allowed to send text messages, rich messages, contacts, giveaways, giveaway winners, invoices, locations and venues
 * @property bool                    $can_send_audios True, if the user is allowed to send audios
 * @property bool                    $can_send_documents True, if the user is allowed to send documents
 * @property bool                    $can_send_photos True, if the user is allowed to send photos
 * @property bool                    $can_send_videos True, if the user is allowed to send videos
 * @property bool                    $can_send_video_notes True, if the user is allowed to send video notes
 * @property bool                    $can_send_voice_notes True, if the user is allowed to send voice notes
 * @property bool                    $can_send_polls True, if the user is allowed to send polls and checklists
 * @property bool                    $can_send_other_messages True, if the user is allowed to send animations, games, stickers and use inline bots
 * @property bool                    $can_add_web_page_previews True, if the user is allowed to add web page previews to their messages
 * @property bool                    $can_react_to_messages True, if the user is allowed to react to messages
 * @property bool                    $can_edit_tag True, if the user is allowed to edit their own tag
 * @property bool                    $can_change_info True, if the user is allowed to change the chat title, photo and other settings
 * @property bool                    $can_invite_users True, if the user is allowed to invite new users to the chat
 * @property bool                    $can_pin_messages True, if the user is allowed to pin messages
 * @property bool                    $can_manage_topics True, if the user is allowed to create forum topics
 * @property \Carbon\CarbonImmutable $until_date Date when restrictions will be lifted for this user; Unix time. If 0, then the user is restricted forever.
 *
 * @link https://core.telegram.org/bots/api#chatmemberrestricted
 *
 * @since v10.3
 */
class ChatMemberRestricted extends ChatMember
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
        'is_member',
        'can_send_messages',
        'can_send_audios',
        'can_send_documents',
        'can_send_photos',
        'can_send_videos',
        'can_send_video_notes',
        'can_send_voice_notes',
        'can_send_polls',
        'can_send_other_messages',
        'can_add_web_page_previews',
        'can_react_to_messages',
        'can_edit_tag',
        'can_change_info',
        'can_invite_users',
        'can_pin_messages',
        'can_manage_topics',
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
