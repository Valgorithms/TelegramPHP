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
 * This object defines the criteria used to request a suitable chat. Information about the selected
 * chat will be shared with the bot when the corresponding button is pressed. The bot will be
 * granted requested rights in the chat if appropriate. More about requesting chats:
 * https://core.telegram.org/bots/features#chat-and-user-selection.
 *
 * @property int                                          $request_id Signed 32-bit identifier of the request, which will be received back in the ChatShared object. Must be unique within the message.
 * @property bool                                         $chat_is_channel Pass True to request a channel chat, pass False to request a group or a supergroup chat
 * @property bool|null                                    $chat_is_forum Optional. Pass True to request a forum supergroup, pass False to request a non-forum chat. If not specified, no additional restrictions are applied.
 * @property bool|null                                    $chat_has_username Optional. Pass True to request a supergroup or a channel with a username, pass False to request a chat without a username. If not specified, no additional restrictions are applied.
 * @property bool|null                                    $chat_is_created Optional. Pass True to request a chat owned by the user. Otherwise, no additional restrictions are applied.
 * @property \Telegram\Parts\ChatAdministratorRights|null $user_administrator_rights Optional. A JSON-serialized object listing the required administrator rights of the user in the chat. The rights must be a superset of bot_administrator_rights. If not specified, no additional restrictions are applied.
 * @property \Telegram\Parts\ChatAdministratorRights|null $bot_administrator_rights Optional. A JSON-serialized object listing the required administrator rights of the bot in the chat. The rights must be a subset of user_administrator_rights. If not specified, no additional restrictions are applied.
 * @property bool|null                                    $bot_is_member Optional. Pass True to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
 * @property bool|null                                    $request_title Optional. Pass True to request the chat's title
 * @property bool|null                                    $request_username Optional. Pass True to request the chat's username
 * @property bool|null                                    $request_photo Optional. Pass True to request the chat's photo
 *
 * @link https://core.telegram.org/bots/api#keyboardbuttonrequestchat
 *
 * @since Bot API 10.3
 */
class KeyboardButtonRequestChat extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'request_id',
        'chat_is_channel',
        'chat_is_forum',
        'chat_has_username',
        'chat_is_created',
        'user_administrator_rights',
        'bot_administrator_rights',
        'bot_is_member',
        'request_title',
        'request_username',
        'request_photo',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user_administrator_rights' => 'ChatAdministratorRights',
        'bot_administrator_rights'  => 'ChatAdministratorRights',
    ];
}
