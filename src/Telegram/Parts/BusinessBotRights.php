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
 * Represents the rights of a business bot.
 *
 * @property bool|null $can_reply Optional. True, if the bot can send and edit messages in the private chats that had incoming messages in the last 24 hours
 * @property bool|null $can_read_messages Optional. True, if the bot can mark incoming private messages as read
 * @property bool|null $can_delete_sent_messages Optional. True, if the bot can delete messages sent by the bot
 * @property bool|null $can_delete_all_messages Optional. True, if the bot can delete all private messages in managed chats
 * @property bool|null $can_edit_name Optional. True, if the bot can edit the first and last name of the business account
 * @property bool|null $can_edit_bio Optional. True, if the bot can edit the bio of the business account
 * @property bool|null $can_edit_profile_photo Optional. True, if the bot can edit the profile photo of the business account
 * @property bool|null $can_edit_username Optional. True, if the bot can edit the username of the business account
 * @property bool|null $can_change_gift_settings Optional. True, if the bot can change the privacy settings pertaining to gifts for the business account
 * @property bool|null $can_view_gifts_and_stars Optional. True, if the bot can view gifts and the amount of Telegram Stars owned by the business account
 * @property bool|null $can_convert_gifts_to_stars Optional. True, if the bot can convert regular gifts owned by the business account to Telegram Stars
 * @property bool|null $can_transfer_and_upgrade_gifts Optional. True, if the bot can transfer and upgrade gifts owned by the business account
 * @property bool|null $can_transfer_stars Optional. True, if the bot can transfer Telegram Stars received by the business account to its own account, or use them to upgrade and transfer gifts
 * @property bool|null $can_manage_stories Optional. True, if the bot can post, edit and delete stories on behalf of the business account
 *
 * @link https://core.telegram.org/bots/api#businessbotrights
 *
 * @since v10.3
 */
class BusinessBotRights extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'can_reply',
        'can_read_messages',
        'can_delete_sent_messages',
        'can_delete_all_messages',
        'can_edit_name',
        'can_edit_bio',
        'can_edit_profile_photo',
        'can_edit_username',
        'can_change_gift_settings',
        'can_view_gifts_and_stars',
        'can_convert_gifts_to_stars',
        'can_transfer_and_upgrade_gifts',
        'can_transfer_stars',
        'can_manage_stories',
    ];
}
