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
 * Rich formatted message.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\RichBlock> $blocks Content of the message
 * @property bool|null                                              $is_rtl Optional. True, if the rich message must be shown right-to-left
 *
 * @link https://core.telegram.org/bots/api#richmessage
 *
 * @since v10.3
 */
class RichMessage extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'blocks',
        'is_rtl',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'blocks' => 'Array of RichBlock',
    ];
}
