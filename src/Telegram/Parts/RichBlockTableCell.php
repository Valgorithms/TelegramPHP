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
 * Cell in a table.
 *
 * @property \Telegram\Parts\RichText|null $text Optional. Text in the cell. If omitted, then the cell is invisible.
 * @property bool|null                     $is_header Optional. True, if the cell is a header cell
 * @property int|null                      $colspan Optional. The number of columns the cell spans if it is bigger than 1
 * @property int|null                      $rowspan Optional. The number of rows the cell spans if it is bigger than 1
 * @property string                        $align Horizontal cell content alignment. Currently, must be one of "left", "center", or "right".
 * @property string                        $valign Vertical cell content alignment. Currently, must be one of "top", "middle", or "bottom".
 *
 * @link https://core.telegram.org/bots/api#richblocktablecell
 *
 * @since Bot API 10.3
 */
class RichBlockTableCell extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'is_header',
        'colspan',
        'rowspan',
        'align',
        'valign',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
