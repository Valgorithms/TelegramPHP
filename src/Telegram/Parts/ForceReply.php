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
 * Upon receiving a message with this object, Telegram clients will display a reply interface to
 * the user (act as if the user has selected the bot's message and tapped 'Reply'). This can be
 * extremely useful if you want to create user-friendly step-by-step interfaces without having to
 * sacrifice privacy mode. Not supported in channels and for messages sent on behalf of a user
 * account.
 *
 * @property bool        $force_reply Shows reply interface to the user, as if they had manually selected the bot's message and tapped 'Reply'
 * @property string|null $input_field_placeholder Optional. The placeholder to be shown in the input field when the reply is active; 1-64 characters
 * @property bool|null   $selective Optional. Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.
 *
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @since Bot API 10.3
 */
class ForceReply extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'force_reply',
        'input_field_placeholder',
        'selective',
    ];
}
