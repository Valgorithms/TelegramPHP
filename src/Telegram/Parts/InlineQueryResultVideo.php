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
 * Represents a link to a page containing an embedded video player or a video file. By default,
 * this video file will be sent by the user with an optional caption. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the video.
 *
 * @property string                                                          $type Type of the result, must be video
 * @property string                                                          $id Unique identifier for this result, 1-64 bytes
 * @property string                                                          $video_url A valid URL for the embedded video player or video file
 * @property string                                                          $mime_type MIME type of the content of the video URL, "text/html" or "video/mp4"
 * @property string                                                          $thumbnail_url URL of the thumbnail (JPEG only) for the video
 * @property string                                                          $title Title for the result
 * @property string|null                                                     $caption Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the video caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool|null                                                       $show_caption_above_media Optional. Pass True if the caption must be shown above the message media
 * @property int|null                                                        $video_width Optional. Video width
 * @property int|null                                                        $video_height Optional. Video height
 * @property int|null                                                        $video_duration Optional. Video duration in seconds
 * @property string|null                                                     $description Optional. Short description of the result
 * @property \Telegram\Parts\InlineKeyboardMarkup|null                       $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null                        $input_message_content Optional. Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @since Bot API 10.3
 */
class InlineQueryResultVideo extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'video_url',
        'mime_type',
        'thumbnail_url',
        'title',
        'caption',
        'parse_mode',
        'caption_entities',
        'show_caption_above_media',
        'video_width',
        'video_height',
        'video_duration',
        'description',
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
