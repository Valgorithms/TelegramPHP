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
 * Describes a service message about an option deleted from a poll.
 *
 * @property \Telegram\Parts\MaybeInaccessibleMessage|null                   $poll_message Optional. Message containing the poll from which the option was deleted, if known. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
 * @property string                                                          $option_persistent_id Unique identifier of the deleted option
 * @property string                                                          $option_text Option text
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $option_text_entities Optional. Special entities that appear in the option_text
 *
 * @link https://core.telegram.org/bots/api#polloptiondeleted
 *
 * @since v10.3
 */
class PollOptionDeleted extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'poll_message',
        'option_persistent_id',
        'option_text',
        'option_text_entities',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'poll_message'         => 'MaybeInaccessibleMessage',
        'option_text_entities' => 'Array of MessageEntity',
    ];
}
