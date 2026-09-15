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
 * Describes actions that a non-administrator user is allowed to take in a chat.
 *
 * @property bool|null $can_send_messages Optional. True, if the user is allowed to send text messages, rich messages, contacts, giveaways, giveaway winners, invoices, locations and venues
 * @property bool|null $can_send_audios Optional. True, if the user is allowed to send audios
 * @property bool|null $can_send_documents Optional. True, if the user is allowed to send documents
 * @property bool|null $can_send_photos Optional. True, if the user is allowed to send photos
 * @property bool|null $can_send_videos Optional. True, if the user is allowed to send videos
 * @property bool|null $can_send_video_notes Optional. True, if the user is allowed to send video notes
 * @property bool|null $can_send_voice_notes Optional. True, if the user is allowed to send voice notes
 * @property bool|null $can_send_polls Optional. True, if the user is allowed to send polls and checklists
 * @property bool|null $can_send_other_messages Optional. True, if the user is allowed to send animations, games, stickers and use inline bots
 * @property bool|null $can_add_web_page_previews Optional. True, if the user is allowed to add web page previews to their messages
 * @property bool|null $can_react_to_messages Optional. True, if the user is allowed to react to messages. If omitted, defaults to the value of can_send_messages.
 * @property bool|null $can_edit_tag Optional. True, if the user is allowed to edit their own tag. If omitted, defaults to the value of can_pin_messages.
 * @property bool|null $can_change_info Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups.
 * @property bool|null $can_invite_users Optional. True, if the user is allowed to invite new users to the chat
 * @property bool|null $can_pin_messages Optional. True, if the user is allowed to pin messages. Ignored in public supergroups.
 * @property bool|null $can_manage_topics Optional. True, if the user is allowed to create forum topics. If omitted, defaults to the value of can_pin_messages.
 *
 * @link https://core.telegram.org/bots/api#chatpermissions
 *
 * @since v10.3
 */
class ChatPermissions extends Part
{
    /** @var list<string> */
    protected array $fillable = [
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
    ];
}
