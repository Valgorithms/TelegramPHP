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
 * Represents a join request sent to a chat.
 *
 * @property \Telegram\Parts\Chat                $chat Chat to which the request was sent
 * @property \Telegram\Parts\User                $from User that sent the join request
 * @property int                                 $user_chat_id Identifier of a private chat with the user who sent the join request. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot can use this identifier for 5 minutes to send messages until the join request is processed, assuming no other administrator contacted the user.
 * @property \Carbon\CarbonImmutable             $date Date the request was sent in Unix time
 * @property string|null                         $bio Optional. Bio of the user
 * @property \Telegram\Parts\ChatInviteLink|null $invite_link Optional. Chat invite link that was used by the user to send the join request
 * @property string|null                         $query_id Optional. Identifier of the join request query; for bots assigned to process join requests only. If present, then the bot must call sendChatJoinRequestWebApp or directly call answerChatJoinRequestQuery within 10 seconds.
 *
 * @link https://core.telegram.org/bots/api#chatjoinrequest
 *
 * @since Bot API 10.3
 */
class ChatJoinRequest extends Part
{
    use Concerns\ChatJoinRequestBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'from',
        'user_chat_id',
        'date',
        'bio',
        'invite_link',
        'query_id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'        => 'Chat',
        'from'        => 'User',
        'invite_link' => 'ChatInviteLink',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
