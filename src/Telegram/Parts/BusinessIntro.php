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
 * Contains information about the start page settings of a Telegram Business account.
 *
 * @property string|null                  $title Optional. Title text of the business intro
 * @property string|null                  $message Optional. Message text of the business intro
 * @property \Telegram\Parts\Sticker|null $sticker Optional. Sticker of the business intro
 *
 * @link https://core.telegram.org/bots/api#businessintro
 *
 * @since Bot API 10.3
 */
class BusinessIntro extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'title',
        'message',
        'sticker',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'sticker' => 'Sticker',
    ];
}
