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
 * An item of a list to be sent.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\InputRichBlock> $blocks The content of the item
 * @property bool|null                                                   $has_checkbox Optional. Pass True if the item has a checkbox
 * @property bool|null                                                   $is_checked Optional. Pass True if the item has a checked checkbox
 * @property int|null                                                    $value Optional. For ordered lists, the numeric value of the item label
 * @property string|null                                                 $type Optional. For ordered lists, the type of the item label; must be one of "a" for lowercase letters, "A" for uppercase letters, "i" for lowercase Roman numerals, "I" for uppercase Roman numerals, or "1" for decimal numbers
 *
 * @link https://core.telegram.org/bots/api#inputrichblocklistitem
 *
 * @since v10.3
 */
class InputRichBlockListItem extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'blocks',
        'has_checkbox',
        'is_checked',
        'value',
        'type',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'blocks' => 'Array of InputRichBlock',
    ];
}
