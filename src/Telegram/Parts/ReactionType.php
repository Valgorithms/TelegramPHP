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
 * This object describes the type of a reaction. Currently, it can be one of
 * - ReactionTypeEmoji
 * - ReactionTypeCustomEmoji
 * - ReactionTypePaid
 *
 * One of: ReactionTypeEmoji, ReactionTypeCustomEmoji, ReactionTypePaid.
 *
 * @link https://core.telegram.org/bots/api#reactiontype
 *
 * @since Bot API 10.3
 */
abstract class ReactionType extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'emoji'        => ReactionTypeEmoji::class,
        'custom_emoji' => ReactionTypeCustomEmoji::class,
        'paid'         => ReactionTypePaid::class,
    ];
}
