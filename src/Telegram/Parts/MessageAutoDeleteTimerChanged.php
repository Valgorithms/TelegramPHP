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
 * This object represents a service message about a change in auto-delete timer settings.
 *
 * @property int $message_auto_delete_time New auto-delete time for messages in the chat; in seconds
 *
 * @link https://core.telegram.org/bots/api#messageautodeletetimerchanged
 *
 * @since v10.3
 */
class MessageAutoDeleteTimerChanged extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'message_auto_delete_time',
    ];
}
