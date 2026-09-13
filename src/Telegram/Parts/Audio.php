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
 * This object represents an audio file to be treated as music by the Telegram clients.
 *
 * @property string                         $file_id Identifier for this file, which can be used to download or reuse the file
 * @property string                         $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int                            $duration Duration of the audio in seconds as defined by the sender
 * @property string|null                    $performer Optional. Performer of the audio as defined by the sender or by audio tags
 * @property string|null                    $title Optional. Title of the audio as defined by the sender or by audio tags
 * @property string|null                    $file_name Optional. Original filename as defined by the sender
 * @property string|null                    $mime_type Optional. MIME type of the file as defined by the sender
 * @property int|null                       $file_size Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
 * @property \Telegram\Parts\PhotoSize|null $thumbnail Optional. Thumbnail of the album cover to which the music file belongs
 *
 * @link https://core.telegram.org/bots/api#audio
 *
 * @since Bot API 10.3
 */
class Audio extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'file_id',
        'file_unique_id',
        'duration',
        'performer',
        'title',
        'file_name',
        'mime_type',
        'file_size',
        'thumbnail',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'thumbnail' => 'PhotoSize',
    ];
}
