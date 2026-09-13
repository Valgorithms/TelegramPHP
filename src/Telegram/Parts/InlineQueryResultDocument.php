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
 * Represents a link to a file. By default, this file will be sent by the user with an optional
 * caption. Alternatively, you can use input_message_content to send a message with the specified
 * content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.
 *
 * @property string                                                          $type Type of the result, must be document
 * @property string                                                          $id Unique identifier for this result, 1-64 bytes
 * @property string                                                          $title Title for the result
 * @property string|null                                                     $caption Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property string                                                          $document_url A valid URL for the file
 * @property string                                                          $mime_type MIME type of the content of the file, either "application/pdf" or "application/zip"
 * @property string|null                                                     $description Optional. Short description of the result
 * @property \Telegram\Parts\InlineKeyboardMarkup|null                       $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null                        $input_message_content Optional. Content of the message to be sent instead of the file
 * @property string|null                                                     $thumbnail_url Optional. URL of the thumbnail (JPEG only) for the file
 * @property int|null                                                        $thumbnail_width Optional. Thumbnail width
 * @property int|null                                                        $thumbnail_height Optional. Thumbnail height
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 *
 * @since Bot API 10.3
 */
class InlineQueryResultDocument extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'title',
        'caption',
        'parse_mode',
        'caption_entities',
        'document_url',
        'mime_type',
        'description',
        'reply_markup',
        'input_message_content',
        'thumbnail_url',
        'thumbnail_width',
        'thumbnail_height',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities'      => 'Array of MessageEntity',
        'reply_markup'          => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}
