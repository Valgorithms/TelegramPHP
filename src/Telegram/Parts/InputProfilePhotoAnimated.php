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
 * An animated profile photo in the MPEG4 format.
 *
 * @property string     $type Type of the profile photo, must be animated
 * @property string     $animation The animated profile photo. Profile photos can't be reused and can only be uploaded as a new file, so you can pass "attach://<file_attach_name>" if the photo was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property float|null $main_frame_timestamp Optional. Timestamp in seconds of the frame that will be used as the static profile photo. Defaults to 0.0.
 *
 * @link https://core.telegram.org/bots/api#inputprofilephotoanimated
 *
 * @since Bot API 10.3
 */
class InputProfilePhotoAnimated extends InputProfilePhoto
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'animation',
        'main_frame_timestamp',
    ];
}
