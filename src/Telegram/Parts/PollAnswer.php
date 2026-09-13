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
 * This object represents an answer of a user in a non-anonymous poll.
 *
 * @property string                    $poll_id Unique poll identifier
 * @property \Telegram\Parts\Chat|null $voter_chat Optional. The chat that changed the answer to the poll, if the voter is anonymous
 * @property \Telegram\Parts\User|null $user Optional. The user that changed the answer to the poll, if the voter isn't anonymous
 * @property array<int, int>           $option_ids 0-based identifiers of chosen answer options. May be empty if the vote was retracted.
 * @property array<int, string>        $option_persistent_ids Persistent identifiers of the chosen answer options. May be empty if the vote was retracted.
 *
 * @link https://core.telegram.org/bots/api#pollanswer
 *
 * @since Bot API 10.3
 */
class PollAnswer extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'poll_id',
        'voter_chat',
        'user',
        'option_ids',
        'option_persistent_ids',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'voter_chat'            => 'Chat',
        'user'                  => 'User',
        'option_ids'            => 'Array of Integer',
        'option_persistent_ids' => 'Array of String',
    ];
}
