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
 * This object represents the content of a poll description or a quiz explanation to be sent. It
 * should be one of
 * - InputMediaAnimation
 * - InputMediaAudio
 * - InputMediaDocument
 * - InputMediaLivePhoto
 * - InputMediaLocation
 * - InputMediaPhoto
 * - InputMediaVenue
 * - InputMediaVideo
 *
 * One of: InputMediaAnimation, InputMediaAudio, InputMediaDocument, InputMediaLivePhoto, InputMediaLocation, InputMediaPhoto, InputMediaVenue, InputMediaVideo.
 *
 * @link https://core.telegram.org/bots/api#inputpollmedia
 *
 * @since v10.3
 */
abstract class InputPollMedia extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'animation'  => InputMediaAnimation::class,
        'audio'      => InputMediaAudio::class,
        'document'   => InputMediaDocument::class,
        'live_photo' => InputMediaLivePhoto::class,
        'location'   => InputMediaLocation::class,
        'photo'      => InputMediaPhoto::class,
        'venue'      => InputMediaVenue::class,
        'video'      => InputMediaVideo::class,
    ];
}
