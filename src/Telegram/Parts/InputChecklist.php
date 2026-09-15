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
 * Describes a checklist to create.
 *
 * @property string                                                          $title Title of the checklist; 1-255 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the title. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $title_entities Optional. List of special entities that appear in the title, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are allowed.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\InputChecklistTask> $tasks List of 1-30 tasks in the checklist
 * @property bool|null                                                       $others_can_add_tasks Optional. Pass True if other users can add tasks to the checklist
 * @property bool|null                                                       $others_can_mark_tasks_as_done Optional. Pass True if other users can mark tasks as done or not done in the checklist
 *
 * @link https://core.telegram.org/bots/api#inputchecklist
 *
 * @since v10.3
 */
class InputChecklist extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'title',
        'parse_mode',
        'title_entities',
        'tasks',
        'others_can_add_tasks',
        'others_can_mark_tasks_as_done',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'title_entities' => 'Array of MessageEntity',
        'tasks'          => 'Array of InputChecklistTask',
    ];
}
