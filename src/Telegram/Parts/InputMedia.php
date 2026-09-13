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
 * This object represents the content of a media message to be sent. It should be one of
 * - InputMediaAnimation
 * - InputMediaAudio
 * - InputMediaDocument
 * - InputMediaLivePhoto
 * - InputMediaPhoto
 * - InputMediaVideo
 *
 * One of: InputMediaAnimation, InputMediaAudio, InputMediaDocument, InputMediaLivePhoto, InputMediaPhoto, InputMediaVideo.
 *
 * @link https://core.telegram.org/bots/api#inputmedia
 *
 * @since Bot API 10.3
 */
abstract class InputMedia extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'animation'  => InputMediaAnimation::class,
        'audio'      => InputMediaAudio::class,
        'document'   => InputMediaDocument::class,
        'live_photo' => InputMediaLivePhoto::class,
        'photo'      => InputMediaPhoto::class,
        'video'      => InputMediaVideo::class,
    ];
}
