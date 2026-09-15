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
 * A table, corresponding to the HTML tag <table>.
 *
 * @property string                                                                                       $type Type of the block, always "table"
 * @property \Discord\Helpers\Collection<\Discord\Helpers\Collection<\Telegram\Parts\RichBlockTableCell>> $cells Cells of the table
 * @property bool|null                                                                                    $is_bordered Optional. True, if the table has borders
 * @property bool|null                                                                                    $is_striped Optional. True, if the table is striped
 * @property bool|null                                                                                    $is_compact Optional. True, if table cells have smaller indents
 * @property \Telegram\Parts\RichText|null                                                                $caption Optional. Caption of the table
 *
 * @link https://core.telegram.org/bots/api#richblocktable
 *
 * @since v10.3
 */
class RichBlockTable extends RichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'cells',
        'is_bordered',
        'is_striped',
        'is_compact',
        'caption',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'cells'   => 'Array of Array of RichBlockTableCell',
        'caption' => 'RichText',
    ];
}
