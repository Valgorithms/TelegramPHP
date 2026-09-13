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
 * The paid media to send is a video.
 *
 * @property string                       $type Type of the media, must be video
 * @property string                       $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                  $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                  $cover Optional. Cover for the video in the message. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property \Carbon\CarbonImmutable|null $start_timestamp Optional. Start timestamp for the video in the message
 * @property int|null                     $width Optional. Video width
 * @property int|null                     $height Optional. Video height
 * @property int|null                     $duration Optional. Video duration in seconds
 * @property bool|null                    $supports_streaming Optional. Pass True if the uploaded video is suitable for streaming
 *
 * @link https://core.telegram.org/bots/api#inputpaidmediavideo
 *
 * @since Bot API 10.3
 */
class InputPaidMediaVideo extends InputPaidMedia
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
        'width',
        'height',
        'duration',
        'supports_streaming',
    ];

    /** @var list<string> */
    protected array $dates = [
        'start_timestamp',
    ];
}
