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
 * A section heading, corresponding to the HTML tags <h1>, <h2>, <h3>, <h4>, <h5>, or <h6>.
 *
 * @property string                   $type Type of the block, always "heading"
 * @property \Telegram\Parts\RichText $text Text of the block
 * @property int                      $size Relative size of the text font; 1-6, 1 is the largest, 6 is the smallest
 *
 * @link https://core.telegram.org/bots/api#inputrichblocksectionheading
 *
 * @since v10.3
 */
class InputRichBlockSectionHeading extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
        'size',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
