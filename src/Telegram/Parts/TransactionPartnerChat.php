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
 * Describes a transaction with a chat.
 *
 * @property string                    $type Type of the transaction partner, always "chat"
 * @property \Telegram\Parts\Chat      $chat Information about the chat
 * @property \Telegram\Parts\Gift|null $gift Optional. The gift sent to the chat by the bot
 *
 * @link https://core.telegram.org/bots/api#transactionpartnerchat
 *
 * @since v10.3
 */
class TransactionPartnerChat extends TransactionPartner
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'chat',
        'gift',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat' => 'Chat',
        'gift' => 'Gift',
    ];
}
