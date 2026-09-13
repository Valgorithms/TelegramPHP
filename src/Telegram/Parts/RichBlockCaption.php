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
 * Caption of a rich formatted block.
 *
 * @property \Telegram\Parts\RichText      $text Block caption
 * @property \Telegram\Parts\RichText|null $credit Optional. Block credit which corresponds to the HTML tag <cite>
 *
 * @link https://core.telegram.org/bots/api#richblockcaption
 *
 * @since Bot API 10.3
 */
class RichBlockCaption extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'text',
        'credit',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text'   => 'RichText',
        'credit' => 'RichText',
    ];
}
