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
 * Represents a link to a photo. By default, this photo will be sent by the user with optional
 * caption. Alternatively, you can use input_message_content to send a message with the specified
 * content instead of the photo.
 *
 * @property string                                                          $type Type of the result, must be photo
 * @property string                                                          $id Unique identifier for this result, 1-64 bytes
 * @property string                                                          $photo_url A valid URL of the photo. Photo must be in JPEG format. Photo size must not exceed 5MB.
 * @property string                                                          $thumbnail_url URL of the thumbnail for the photo
 * @property int|null                                                        $photo_width Optional. Width of the photo
 * @property int|null                                                        $photo_height Optional. Height of the photo
 * @property string|null                                                     $title Optional. Title for the result
 * @property string|null                                                     $description Optional. Short description of the result
 * @property string|null                                                     $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool|null                                                       $show_caption_above_media Optional. Pass True if the caption must be shown above the message media
 * @property \Telegram\Parts\InlineKeyboardMarkup|null                       $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null                        $input_message_content Optional. Content of the message to be sent instead of the photo
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @since Bot API 10.3
 */
class InlineQueryResultPhoto extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'photo_url',
        'thumbnail_url',
        'photo_width',
        'photo_height',
        'title',
        'description',
        'caption',
        'parse_mode',
        'caption_entities',
        'show_caption_above_media',
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
