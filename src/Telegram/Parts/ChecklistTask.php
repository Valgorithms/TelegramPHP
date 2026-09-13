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
 * Describes a task in a checklist.
 *
 * @property int                                                             $id Unique identifier of the task
 * @property string                                                          $text Text of the task
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $text_entities Optional. Special entities that appear in the task text
 * @property \Telegram\Parts\User|null                                       $completed_by_user Optional. User that completed the task; omitted if the task wasn't completed by a user
 * @property \Telegram\Parts\Chat|null                                       $completed_by_chat Optional. Chat that completed the task; omitted if the task wasn't completed by a chat
 * @property \Carbon\CarbonImmutable|null                                    $completion_date Optional. Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed
 *
 * @link https://core.telegram.org/bots/api#checklisttask
 *
 * @since Bot API 10.3
 */
class ChecklistTask extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'text',
        'text_entities',
        'completed_by_user',
        'completed_by_chat',
        'completion_date',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text_entities'     => 'Array of MessageEntity',
        'completed_by_user' => 'User',
        'completed_by_chat' => 'Chat',
    ];

    /** @var list<string> */
    protected array $dates = [
        'completion_date',
    ];
}
