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
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport
 * files are in JPEG format when decrypted and don't exceed 10MB.
 *
 * @property string                  $file_id Identifier for this file, which can be used to download or reuse the file
 * @property string                  $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int                     $file_size File size in bytes
 * @property \Carbon\CarbonImmutable $file_date Unix time when the file was uploaded
 *
 * @link https://core.telegram.org/bots/api#passportfile
 *
 * @since Bot API 10.3
 */
class PassportFile extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'file_id',
        'file_unique_id',
        'file_size',
        'file_date',
    ];

    /** @var list<string> */
    protected array $dates = [
        'file_date',
    ];
}
