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
 * This object represents a Telegram user or bot.
 *
 * @property int         $id Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property bool        $is_bot True, if this user is a bot
 * @property string      $first_name User's or bot's first name
 * @property string|null $last_name Optional. User's or bot's last name
 * @property string|null $username Optional. User's or bot's username
 * @property string|null $language_code Optional. IETF language tag of the user's language
 * @property bool|null   $is_premium Optional. True, if this user is a Telegram Premium user
 * @property bool|null   $added_to_attachment_menu Optional. True, if this user added the bot to the attachment menu
 * @property bool|null   $can_join_groups Optional. True, if the bot can be invited to groups. Returned only in getMe.
 * @property bool|null   $can_read_all_group_messages Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
 * @property bool|null   $supports_guest_queries Optional. True, if the bot supports guest queries from chats it is not a member of. Returned only in getMe.
 * @property bool|null   $supports_inline_queries Optional. True, if the bot supports inline queries. Returned only in getMe.
 * @property bool|null   $can_connect_to_business Optional. True, if the bot can be connected to a user account to manage it. Returned only in getMe.
 * @property bool|null   $has_main_web_app Optional. True, if the bot has a main Web App. Returned only in getMe.
 * @property bool|null   $has_topics_enabled Optional. True, if the bot has forum topic mode enabled in private chats. Returned only in getMe.
 * @property bool|null   $allows_users_to_create_topics Optional. True, if the bot allows users to create and delete topics in private chats. Returned only in getMe.
 * @property bool|null   $can_manage_bots Optional. True, if other bots can be created to be controlled by the bot. Returned only in getMe.
 * @property bool|null   $supports_join_request_queries Optional. True, if the bot supports join request queries and can be assigned to process them. Returned only in getMe.
 *
 * @link https://core.telegram.org/bots/api#user
 *
 * @since v10.3
 */
class User extends Part
{
    use Concerns\UserBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'is_bot',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'is_premium',
        'added_to_attachment_menu',
        'can_join_groups',
        'can_read_all_group_messages',
        'supports_guest_queries',
        'supports_inline_queries',
        'can_connect_to_business',
        'has_main_web_app',
        'has_topics_enabled',
        'allows_users_to_create_topics',
        'can_manage_bots',
        'supports_join_request_queries',
    ];
}
