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
 * This object describes the paid media to be sent. Currently, it can be one of
 * - InputPaidMediaLivePhoto
 * - InputPaidMediaPhoto
 * - InputPaidMediaVideo
 *
 * One of: InputPaidMediaLivePhoto, InputPaidMediaPhoto, InputPaidMediaVideo.
 *
 * @link https://core.telegram.org/bots/api#inputpaidmedia
 *
 * @since v10.3
 */
abstract class InputPaidMedia extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'live_photo' => InputPaidMediaLivePhoto::class,
        'photo'      => InputPaidMediaPhoto::class,
        'video'      => InputPaidMediaVideo::class,
    ];
}
