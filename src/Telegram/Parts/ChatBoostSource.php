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
 * This object describes the source of a chat boost. It can be one of
 * - ChatBoostSourcePremium
 * - ChatBoostSourceGiftCode
 * - ChatBoostSourceGiveaway
 *
 * One of: ChatBoostSourcePremium, ChatBoostSourceGiftCode, ChatBoostSourceGiveaway.
 *
 * @link https://core.telegram.org/bots/api#chatboostsource
 *
 * @since Bot API 10.3
 */
abstract class ChatBoostSource extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'source';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'premium'   => ChatBoostSourcePremium::class,
        'gift_code' => ChatBoostSourceGiftCode::class,
        'giveaway'  => ChatBoostSourceGiveaway::class,
    ];
}
