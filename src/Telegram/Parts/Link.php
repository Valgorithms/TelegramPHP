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
 * Represents an HTTP link.
 *
 * @property string $url URL of the link
 *
 * @link https://core.telegram.org/bots/api#link
 *
 * @since v10.3
 */
class Link extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'url',
    ];
}
