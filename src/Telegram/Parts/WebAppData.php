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
 * Describes data sent from a Web App to the bot.
 *
 * @property string $data The data. Be aware that a bad client can send arbitrary data in this field.
 * @property string $button_text Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
 *
 * @link https://core.telegram.org/bots/api#webappdata
 *
 * @since Bot API 10.3
 */
class WebAppData extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'data',
        'button_text',
    ];
}
