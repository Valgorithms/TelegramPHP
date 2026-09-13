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
 * An expandable block for details disclosure, corresponding to the HTML tag <details>.
 *
 * @property string                                                      $type Type of the block, always "details"
 * @property \Telegram\Parts\RichText                                    $summary Always shown summary of the block
 * @property \Discord\Helpers\Collection<\Telegram\Parts\InputRichBlock> $blocks Content of the block
 * @property bool|null                                                   $is_open Optional. Pass True if the content of the block is visible by default
 *
 * @link https://core.telegram.org/bots/api#inputrichblockdetails
 *
 * @since Bot API 10.3
 */
class InputRichBlockDetails extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'summary',
        'blocks',
        'is_open',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'summary' => 'RichText',
        'blocks'  => 'Array of InputRichBlock',
    ];
}
