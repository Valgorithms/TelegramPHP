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
 * A block containing a list of buttons that are shown in one row, corresponding to the custom HTML
 * tag <tg-button-row>.
 *
 * @property string                                                         $type Type of the block, always "buttons"
 * @property \Discord\Helpers\Collection<\Telegram\Parts\RichMessageButton> $buttons List of 1-8 buttons to send
 * @property string|null                                                    $align Optional. Horizontal alignment of the buttons. Currently, must be one of "left", "center", or "right".
 *
 * @link https://core.telegram.org/bots/api#inputrichblockbuttons
 *
 * @since Bot API 10.3
 */
class InputRichBlockButtons extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'buttons',
        'align',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'buttons' => 'Array of RichMessageButton',
    ];
}
