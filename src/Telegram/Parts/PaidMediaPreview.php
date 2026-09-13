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
 * The paid media isn't available before the payment.
 *
 * @property string   $type Type of the paid media, always "preview"
 * @property int|null $width Optional. Media width as defined by the sender
 * @property int|null $height Optional. Media height as defined by the sender
 * @property int|null $duration Optional. Duration of the media in seconds as defined by the sender
 *
 * @link https://core.telegram.org/bots/api#paidmediapreview
 *
 * @since Bot API 10.3
 */
class PaidMediaPreview extends PaidMedia
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'width',
        'height',
        'duration',
    ];
}
