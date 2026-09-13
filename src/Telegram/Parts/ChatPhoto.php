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
 * This object represents a chat photo.
 *
 * @property string $small_file_id File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
 * @property string $small_file_unique_id Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property string $big_file_id File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
 * @property string $big_file_unique_id Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 *
 * @link https://core.telegram.org/bots/api#chatphoto
 *
 * @since Bot API 10.3
 */
class ChatPhoto extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'small_file_id',
        'small_file_unique_id',
        'big_file_id',
        'big_file_unique_id',
    ];
}
