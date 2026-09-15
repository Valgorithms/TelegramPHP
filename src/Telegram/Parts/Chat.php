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
 * This object represents a chat.
 *
 * @property int         $id Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property string      $type Type of the chat, can be either "private", "group", "supergroup" or "channel"
 * @property string|null $title Optional. Title, for supergroups, channels and group chats
 * @property string|null $username Optional. Username, for private chats, supergroups and channels if available
 * @property string|null $first_name Optional. First name of the other party in a private chat
 * @property string|null $last_name Optional. Last name of the other party in a private chat
 * @property bool|null   $is_forum Optional. True, if the supergroup chat is a forum (has topics enabled)
 * @property bool|null   $is_direct_messages Optional. True, if the chat is the direct messages chat of a channel
 *
 * @link https://core.telegram.org/bots/api#chat
 *
 * @since v10.3
 */
class Chat extends Part
{
    use Concerns\ChatBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'type',
        'title',
        'username',
        'first_name',
        'last_name',
        'is_forum',
        'is_direct_messages',
    ];
}
