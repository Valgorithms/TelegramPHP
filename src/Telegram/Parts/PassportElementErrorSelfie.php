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
 * Represents an issue with the selfie with a document. The error is considered resolved when the
 * file with the selfie changes.
 *
 * @property string $source Error source, must be selfie
 * @property string $type The section of the user's Telegram Passport which has the issue, one of "passport", "driver_license", "identity_card", "internal_passport"
 * @property string $file_hash Base64-encoded hash of the file with the selfie
 * @property string $message Error message
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorselfie
 *
 * @since Bot API 10.3
 */
class PassportElementErrorSelfie extends PassportElementError
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'source',
        'type',
        'file_hash',
        'message',
    ];
}
