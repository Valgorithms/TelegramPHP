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
 * Describes a task to add to a checklist.
 *
 * @property int                                                             $id Unique identifier of the task; must be positive and unique among all task identifiers currently present in the checklist
 * @property string                                                          $text Text of the task; 1-100 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the text. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $text_entities Optional. List of special entities that appear in the text, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are allowed.
 *
 * @link https://core.telegram.org/bots/api#inputchecklisttask
 *
 * @since v10.3
 */
class InputChecklistTask extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'text',
        'parse_mode',
        'text_entities',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text_entities' => 'Array of MessageEntity',
    ];
}
