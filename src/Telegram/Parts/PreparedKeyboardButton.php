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
 * Describes a keyboard button to be used by a user of a Mini App.
 *
 * @property string $id Unique identifier of the keyboard button
 *
 * @link https://core.telegram.org/bots/api#preparedkeyboardbutton
 *
 * @since v10.3
 */
class PreparedKeyboardButton extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
    ];
}
