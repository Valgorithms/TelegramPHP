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
 * Represents an issue in an unspecified place. The error is considered resolved when new data is
 * added.
 *
 * @property string $source Error source, must be unspecified
 * @property string $type Type of element of the user's Telegram Passport which has the issue
 * @property string $element_hash Base64-encoded element hash
 * @property string $message Error message
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorunspecified
 *
 * @since Bot API 10.3
 */
class PassportElementErrorUnspecified extends PassportElementError
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'source',
        'type',
        'element_hash',
        'message',
    ];
}
