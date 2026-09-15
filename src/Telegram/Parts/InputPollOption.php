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
 * This object contains information about one answer option in a poll to be sent.
 *
 * @property string                                                          $text Option text, 1-100 characters
 * @property string|null                                                     $text_parse_mode Optional. Mode for parsing entities in the text. See formatting options for more details. Currently, only custom emoji entities are allowed.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $text_entities Optional. A JSON-serialized list of special entities that appear in the poll option text. It can be specified instead of text_parse_mode.
 * @property \Telegram\Parts\InputPollOptionMedia|null                       $media Optional. Media added to the poll option
 *
 * @link https://core.telegram.org/bots/api#inputpolloption
 *
 * @since v10.3
 */
class InputPollOption extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'text_parse_mode',
        'text_entities',
        'media',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text_entities' => 'Array of MessageEntity',
        'media'         => 'InputPollOptionMedia',
    ];
}
