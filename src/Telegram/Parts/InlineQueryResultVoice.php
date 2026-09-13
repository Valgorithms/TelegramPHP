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
 * Represents a link to a voice recording in an .OGG container encoded with OPUS. By default, this
 * voice recording will be sent by the user. Alternatively, you can use input_message_content to
 * send a message with the specified content instead of the the voice message.
 *
 * @property string                                                          $type Type of the result, must be voice
 * @property string                                                          $id Unique identifier for this result, 1-64 bytes
 * @property string                                                          $voice_url A valid URL for the voice recording
 * @property string                                                          $title Recording title
 * @property string|null                                                     $caption Optional. Caption, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property int|null                                                        $voice_duration Optional. Recording duration in seconds
 * @property \Telegram\Parts\InlineKeyboardMarkup|null                       $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null                        $input_message_content Optional. Content of the message to be sent instead of the voice recording
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 *
 * @since Bot API 10.3
 */
class InlineQueryResultVoice extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'voice_url',
        'title',
        'caption',
        'parse_mode',
        'caption_entities',
        'voice_duration',
        'reply_markup',
        'input_message_content',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities'      => 'Array of MessageEntity',
        'reply_markup'          => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}
