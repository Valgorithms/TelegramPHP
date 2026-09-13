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
 * The boost was obtained by the creation of a Telegram Premium or a Telegram Star giveaway. This
 * boosts the chat 4 times for the duration of the corresponding Telegram Premium subscription for
 * Telegram Premium giveaways and prize_star_count / 500 times for one year for Telegram Star
 * giveaways.
 *
 * @property string                    $source Source of the boost, always "giveaway"
 * @property int                       $giveaway_message_id Identifier of a message in the chat with the giveaway; the message could have been deleted already. May be 0 if the message isn't sent yet.
 * @property \Telegram\Parts\User|null $user Optional. User that won the prize in the giveaway if any; for Telegram Premium giveaways only
 * @property int|null                  $prize_star_count Optional. The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
 * @property bool|null                 $is_unclaimed Optional. True, if the giveaway was completed, but there was no user to win the prize
 *
 * @link https://core.telegram.org/bots/api#chatboostsourcegiveaway
 *
 * @since Bot API 10.3
 */
class ChatBoostSourceGiveaway extends ChatBoostSource
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'source',
        'giveaway_message_id',
        'user',
        'prize_star_count',
        'is_unclaimed',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
