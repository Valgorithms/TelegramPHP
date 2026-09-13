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
 * The paid media is a live photo.
 *
 * @property string                    $type Type of the paid media, always "live_photo"
 * @property \Telegram\Parts\LivePhoto $live_photo The photo
 *
 * @link https://core.telegram.org/bots/api#paidmedialivephoto
 *
 * @since Bot API 10.3
 */
class PaidMediaLivePhoto extends PaidMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'live_photo',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'live_photo' => 'LivePhoto',
    ];
}
