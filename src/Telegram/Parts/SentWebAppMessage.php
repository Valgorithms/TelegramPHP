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
 * Describes an inline message sent by a Web App on behalf of a user.
 *
 * @property string|null $inline_message_id Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
 *
 * @link https://core.telegram.org/bots/api#sentwebappmessage
 *
 * @since v10.3
 */
class SentWebAppMessage extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'inline_message_id',
    ];
}
