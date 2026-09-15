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
 * This object represents a bot command.
 *
 * @property string    $command Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
 * @property string    $description Description of the command; 1-256 characters
 * @property bool|null $is_ephemeral Optional. True, if the command sends an ephemeral message, which can be seen only by the sender of the message and the bot
 *
 * @link https://core.telegram.org/bots/api#botcommand
 *
 * @since v10.3
 */
class BotCommand extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'command',
        'description',
        'is_ephemeral',
    ];
}
