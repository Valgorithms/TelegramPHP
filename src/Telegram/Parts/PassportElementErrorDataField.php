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
 * Represents an issue in one of the data fields that was provided by the user. The error is
 * considered resolved when the field's value changes.
 *
 * @property string $source Error source, must be data
 * @property string $type The section of the user's Telegram Passport which has the error, one of "personal_details", "passport", "driver_license", "identity_card", "internal_passport", "address"
 * @property string $field_name Name of the data field which has the error
 * @property string $data_hash Base64-encoded data hash
 * @property string $message Error message
 *
 * @link https://core.telegram.org/bots/api#passportelementerrordatafield
 *
 * @since Bot API 10.3
 */
class PassportElementErrorDataField extends PassportElementError
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'source',
        'type',
        'field_name',
        'data_hash',
        'message',
    ];
}
