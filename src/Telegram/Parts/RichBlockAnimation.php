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
 * A block with an animation, corresponding to the HTML tag <video>.
 *
 * @property string                                $type Type of the block, always "animation"
 * @property \Telegram\Parts\Animation             $animation The animation
 * @property bool|null                             $has_spoiler Optional. True, if the media preview is covered by a spoiler animation
 * @property \Telegram\Parts\RichBlockCaption|null $caption Optional. Caption of the block
 *
 * @link https://core.telegram.org/bots/api#richblockanimation
 *
 * @since v10.3
 */
class RichBlockAnimation extends RichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'animation',
        'has_spoiler',
        'caption',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'animation' => 'Animation',
        'caption'   => 'RichBlockCaption',
    ];
}
