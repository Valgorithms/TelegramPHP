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
 * This object represents a video file.
 *
 * @property string                                                         $file_id Identifier for this file, which can be used to download or reuse the file
 * @property string                                                         $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int                                                            $width Video width as defined by the sender
 * @property int                                                            $height Video height as defined by the sender
 * @property int                                                            $duration Duration of the video in seconds as defined by the sender
 * @property \Telegram\Parts\PhotoSize|null                                 $thumbnail Optional. Video thumbnail
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null    $cover Optional. Available sizes of the cover of the video in the message
 * @property \Carbon\CarbonImmutable|null                                   $start_timestamp Optional. Timestamp in seconds from which the video will play in the message
 * @property \Discord\Helpers\Collection<\Telegram\Parts\VideoQuality>|null $qualities Optional. List of available qualities of the video
 * @property string|null                                                    $file_name Optional. Original filename as defined by the sender
 * @property string|null                                                    $mime_type Optional. MIME type of the file as defined by the sender
 * @property int|null                                                       $file_size Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
 *
 * @link https://core.telegram.org/bots/api#video
 *
 * @since v10.3
 */
class Video extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'file_id',
        'file_unique_id',
        'width',
        'height',
        'duration',
        'thumbnail',
        'cover',
        'start_timestamp',
        'qualities',
        'file_name',
        'mime_type',
        'file_size',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'thumbnail' => 'PhotoSize',
        'cover'     => 'Array of PhotoSize',
        'qualities' => 'Array of VideoQuality',
    ];

    /** @var list<string> */
    protected array $dates = [
        'start_timestamp',
    ];
}
