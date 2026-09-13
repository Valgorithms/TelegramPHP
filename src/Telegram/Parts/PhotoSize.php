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
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @property string   $file_id Identifier for this file, which can be used to download or reuse the file
 * @property string   $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int      $width Photo width
 * @property int      $height Photo height
 * @property int|null $file_size Optional. File size in bytes
 *
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @since Bot API 10.3
 */
class PhotoSize extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'file_id',
        'file_unique_id',
        'width',
        'height',
        'file_size',
    ];
}
