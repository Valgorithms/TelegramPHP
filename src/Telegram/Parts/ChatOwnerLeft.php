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
 * Describes a service message about the chat owner leaving the chat.
 *
 * @property \Telegram\Parts\User|null $new_owner Optional. The user who will become the new owner of the chat if the previous owner does not return to the chat
 *
 * @link https://core.telegram.org/bots/api#chatownerleft
 *
 * @since Bot API 10.3
 */
class ChatOwnerLeft extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'new_owner',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'new_owner' => 'User',
    ];
}
