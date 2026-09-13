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
 * This object contains information about one answer option in a poll.
 *
 * @property string                                                          $persistent_id Unique identifier of the option, persistent on option addition and deletion
 * @property string                                                          $text Option text, 1-100 characters
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $text_entities Optional. Special entities that appear in the option text. Currently, only custom emoji entities are allowed in poll option texts
 * @property \Telegram\Parts\PollMedia|null                                  $media Optional. Media added to the poll option
 * @property int                                                             $voter_count Number of users who voted for this option; may be 0 if unknown
 * @property \Telegram\Parts\User|null                                       $added_by_user Optional. User who added the option; omitted if the option wasn't added by a user after poll creation
 * @property \Telegram\Parts\Chat|null                                       $added_by_chat Optional. Chat that added the option; omitted if the option wasn't added by a chat after poll creation
 * @property \Carbon\CarbonImmutable|null                                    $addition_date Optional. Point in time (Unix timestamp) when the option was added; omitted if the option existed in the original poll
 *
 * @link https://core.telegram.org/bots/api#polloption
 *
 * @since Bot API 10.3
 */
class PollOption extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'persistent_id',
        'text',
        'text_entities',
        'media',
        'voter_count',
        'added_by_user',
        'added_by_chat',
        'addition_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text_entities' => 'Array of MessageEntity',
        'media'         => 'PollMedia',
        'added_by_user' => 'User',
        'added_by_chat' => 'Chat',
    ];

    /** @var list<string> */
    protected array $dates = [
        'addition_date',
    ];
}
