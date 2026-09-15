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
 * Represents a video to be sent.
 *
 * @property string                                                          $type Type of the media, must be video
 * @property string                                                          $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $cover Optional. Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property \Carbon\CarbonImmutable|null                                    $start_timestamp Optional. Start timestamp for the video in the message
 * @property string|null                                                     $caption Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the video caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool|null                                                       $show_caption_above_media Optional. Pass True if the caption must be shown above the message media
 * @property int|null                                                        $width Optional. Video width
 * @property int|null                                                        $height Optional. Video height
 * @property int|null                                                        $duration Optional. Video duration in seconds
 * @property bool|null                                                       $supports_streaming Optional. Pass True if the uploaded video is suitable for streaming
 * @property bool|null                                                       $has_spoiler Optional. Pass True if the video needs to be covered with a spoiler animation
 *
 * @link https://core.telegram.org/bots/api#inputmediavideo
 *
 * @since v10.3
 */
class InputMediaVideo extends InputPollMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'media',
        'thumbnail',
        'cover',
        'start_timestamp',
        'caption',
        'parse_mode',
        'caption_entities',
        'show_caption_above_media',
        'width',
        'height',
        'duration',
        'supports_streaming',
        'has_spoiler',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities' => 'Array of MessageEntity',
    ];

    /** @var list<string> */
    protected array $dates = [
        'start_timestamp',
    ];
}
