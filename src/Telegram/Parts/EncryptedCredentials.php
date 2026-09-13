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
 * Describes data required for decrypting and authenticating EncryptedPassportElement. See the
 * Telegram Passport Documentation for a complete description of the data decryption and
 * authentication processes.
 *
 * @property string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
 * @property string $hash Base64-encoded data hash for data authentication
 * @property string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
 *
 * @link https://core.telegram.org/bots/api#encryptedcredentials
 *
 * @since Bot API 10.3
 */
class EncryptedCredentials extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'data',
        'hash',
        'secret',
    ];
}
