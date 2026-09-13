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
 * Represents a photo to be sent.
 *
 * @property string                                                          $type Type of the media, must be photo
 * @property string                                                          $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string|null                                                     $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
 * @property bool|null                                                       $show_caption_above_media Optional. Pass True if the caption must be shown above the message media
 * @property bool|null                                                       $has_spoiler Optional. Pass True if the photo needs to be covered with a spoiler animation
 *
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 *
 * @since Bot API 10.3
 */
class InputMediaPhoto extends InputPollMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'media',
        'caption',
        'parse_mode',
        'caption_entities',
        'show_caption_above_media',
        'has_spoiler',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'caption_entities' => 'Array of MessageEntity',
    ];
}
