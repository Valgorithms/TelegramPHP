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
 * Describes why a request was unsuccessful.
 *
 * @property int|null $migrate_to_chat_id Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property int|null $retry_after Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
 *
 * @link https://core.telegram.org/bots/api#responseparameters
 *
 * @since v10.3
 */
class ResponseParameters extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'migrate_to_chat_id',
        'retry_after',
    ];
}
