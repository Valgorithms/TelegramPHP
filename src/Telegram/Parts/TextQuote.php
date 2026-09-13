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
 * This object contains information about the quoted part of a message that is replied to by the
 * given message.
 *
 * @property string                                                          $text Text of the quoted part of a message that is replied to by the given message
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. Special entities that appear in the quote. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are kept in quotes.
 * @property int                                                             $position Approximate quote position in the original message in UTF-16 code units as specified by the sender
 * @property bool|null                                                       $is_manual Optional. True, if the quote was chosen manually by the message sender. Otherwise, the quote was added automatically by the server.
 *
 * @link https://core.telegram.org/bots/api#textquote
 *
 * @since Bot API 10.3
 */
class TextQuote extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'entities',
        'position',
        'is_manual',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'entities' => 'Array of MessageEntity',
    ];
}
