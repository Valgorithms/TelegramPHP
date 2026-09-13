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
 * A block quotation, corresponding to the HTML tag <blockquote>.
 *
 * @property string                                                 $type Type of the block, always "blockquote"
 * @property \Discord\Helpers\Collection<\Telegram\Parts\RichBlock> $blocks Content of the block
 * @property \Telegram\Parts\RichText|null                          $credit Optional. Credit of the block
 *
 * @link https://core.telegram.org/bots/api#richblockblockquotation
 *
 * @since Bot API 10.3
 */
class RichBlockBlockQuotation extends RichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'blocks',
        'credit',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'blocks' => 'Array of RichBlock',
        'credit' => 'RichText',
    ];
}
