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
 * Describes a service message about tasks added to a checklist.
 *
 * @property \Telegram\Parts\Message|null                               $checklist_message Optional. Message containing the checklist to which the tasks were added. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ChecklistTask> $tasks List of tasks added to the checklist
 *
 * @link https://core.telegram.org/bots/api#checklisttasksadded
 *
 * @since v10.3
 */
class ChecklistTasksAdded extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'checklist_message',
        'tasks',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'checklist_message' => 'Message',
        'tasks'             => 'Array of ChecklistTask',
    ];
}
