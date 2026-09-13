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
 * Describes Telegram Passport data shared with the bot by the user.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\EncryptedPassportElement> $data Array with information about documents and other Telegram Passport elements that was shared with the bot
 * @property \Telegram\Parts\EncryptedCredentials                                  $credentials Encrypted credentials required to decrypt the data
 *
 * @link https://core.telegram.org/bots/api#passportdata
 *
 * @since Bot API 10.3
 */
class PassportData extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'data',
        'credentials',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'data'        => 'Array of EncryptedPassportElement',
        'credentials' => 'EncryptedCredentials',
    ];
}
