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
 * The paid media is a photo.
 *
 * @property string                                                 $type Type of the paid media, always "photo"
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize> $photo The photo
 *
 * @link https://core.telegram.org/bots/api#paidmediaphoto
 *
 * @since v10.3
 */
class PaidMediaPhoto extends PaidMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'photo',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo' => 'Array of PhotoSize',
    ];
}
