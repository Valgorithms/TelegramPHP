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
 * This object represents a change of a reaction on a message performed by a user.
 *
 * @property \Telegram\Parts\Chat                                      $chat The chat containing the message the user reacted to
 * @property int                                                       $message_id Unique identifier of the message inside the chat
 * @property \Telegram\Parts\User|null                                 $user Optional. The user that changed the reaction, if the user isn't anonymous
 * @property \Telegram\Parts\Chat|null                                 $actor_chat Optional. The chat on behalf of which the reaction was changed, if the user is anonymous
 * @property \Carbon\CarbonImmutable                                   $date Date of the change in Unix time
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ReactionType> $old_reaction Previous list of reaction types that were set by the user
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ReactionType> $new_reaction New list of reaction types that have been set by the user
 *
 * @link https://core.telegram.org/bots/api#messagereactionupdated
 *
 * @since Bot API 10.3
 */
class MessageReactionUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'chat',
        'message_id',
        'user',
        'actor_chat',
        'date',
        'old_reaction',
        'new_reaction',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat'         => 'Chat',
        'user'         => 'User',
        'actor_chat'   => 'Chat',
        'old_reaction' => 'Array of ReactionType',
        'new_reaction' => 'Array of ReactionType',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
