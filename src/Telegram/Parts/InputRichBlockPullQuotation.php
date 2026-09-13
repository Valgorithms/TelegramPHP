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
 * A quotation with centered text, loosely corresponding to the HTML tag <aside>.
 *
 * @property string                        $type Type of the block, always "pullquote"
 * @property \Telegram\Parts\RichText      $text Text of the block
 * @property \Telegram\Parts\RichText|null $credit Optional. Credit of the block
 *
 * @link https://core.telegram.org/bots/api#inputrichblockpullquotation
 *
 * @since Bot API 10.3
 */
class InputRichBlockPullQuotation extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
        'credit',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text'   => 'RichText',
        'credit' => 'RichText',
    ];
}
