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
 * Describes a checklist.
 *
 * @property string                                                          $title Title of the checklist
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $title_entities Optional. Special entities that appear in the checklist title
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ChecklistTask>      $tasks List of tasks in the checklist
 * @property bool|null                                                       $others_can_add_tasks Optional. True, if users other than the creator of the list can add tasks to the list
 * @property bool|null                                                       $others_can_mark_tasks_as_done Optional. True, if users other than the creator of the list can mark tasks as done or not done
 *
 * @link https://core.telegram.org/bots/api#checklist
 *
 * @since Bot API 10.3
 */
class Checklist extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'title',
        'title_entities',
        'tasks',
        'others_can_add_tasks',
        'others_can_mark_tasks_as_done',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'title_entities' => 'Array of MessageEntity',
        'tasks'          => 'Array of ChecklistTask',
    ];
}
