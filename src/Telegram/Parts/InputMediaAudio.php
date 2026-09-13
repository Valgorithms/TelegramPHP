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
 * Represents an audio file to be treated as music to be sent.
 *
 * @property string                                                          $type Type of the media, must be audio
 * @property string                                                          $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $caption Optional. Caption of the audio to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property int|null                                                        $duration Optional. Duration of the audio in seconds
 * @property string|null                                                     $performer Optional. Performer of the audio
 * @property string|null                                                     $title Optional. Title of the audio
 *
 * @link https://core.telegram.org/bots/api#inputmediaaudio
 *
 * @since Bot API 10.3
 */
class InputMediaAudio extends InputPollMedia
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
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
        'performer',
        'title',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities' => 'Array of MessageEntity',
    ];
}
