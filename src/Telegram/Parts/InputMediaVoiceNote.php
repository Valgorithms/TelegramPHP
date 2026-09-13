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
 * Represents a voice message file to be sent.
 *
 * @property string                                                          $type Type of the media, must be voice_note
 * @property string                                                          $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $caption Optional. Caption of the voice message to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property int|null                                                        $duration Optional. Duration of the voice message in seconds
 *
 * @link https://core.telegram.org/bots/api#inputmediavoicenote
 *
 * @since Bot API 10.3
 */
class InputMediaVoiceNote extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'type',
        'media',
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities' => 'Array of MessageEntity',
    ];
}
