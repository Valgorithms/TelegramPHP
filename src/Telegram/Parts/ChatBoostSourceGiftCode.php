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
 * The boost was obtained by the creation of Telegram Premium gift codes to boost a chat. Each such
 * code boosts the chat 4 times for the duration of the corresponding Telegram Premium
 * subscription.
 *
 * @property string               $source Source of the boost, always "gift_code"
 * @property \Telegram\Parts\User $user User for which the gift code was created
 *
 * @link https://core.telegram.org/bots/api#chatboostsourcegiftcode
 *
 * @since Bot API 10.3
 */
class ChatBoostSourceGiftCode extends ChatBoostSource
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'source',
        'user',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
