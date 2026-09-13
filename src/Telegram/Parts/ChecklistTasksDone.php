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
 * Describes a service message about checklist tasks marked as done or not done.
 *
 * @property \Telegram\Parts\Message|null $checklist_message Optional. Message containing the checklist whose tasks were marked as done or not done. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property array<int, int>|null         $marked_as_done_task_ids Optional. Identifiers of the tasks that were marked as done
 * @property array<int, int>|null         $marked_as_not_done_task_ids Optional. Identifiers of the tasks that were marked as not done
 *
 * @link https://core.telegram.org/bots/api#checklisttasksdone
 *
 * @since Bot API 10.3
 */
class ChecklistTasksDone extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'checklist_message',
        'marked_as_done_task_ids',
        'marked_as_not_done_task_ids',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'checklist_message'           => 'Message',
        'marked_as_done_task_ids'     => 'Array of Integer',
        'marked_as_not_done_task_ids' => 'Array of Integer',
    ];
}
