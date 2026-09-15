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
 * A block with a photo, corresponding to the HTML tag <img>.
 *
 * @property string                                $type Type of the block, always "photo"
 * @property \Telegram\Parts\InputMediaPhoto       $photo The photo. Caption is ignored.
 * @property \Telegram\Parts\RichBlockCaption|null $caption Optional. Caption of the block
 *
 * @link https://core.telegram.org/bots/api#inputrichblockphoto
 *
 * @since v10.3
 */
class InputRichBlockPhoto extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'photo',
        'caption',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo'   => 'InputMediaPhoto',
        'caption' => 'RichBlockCaption',
    ];
}
