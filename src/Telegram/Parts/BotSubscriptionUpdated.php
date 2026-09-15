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
 * This object contains information about changes to a user payment subscription toward the current
 * bot.
 *
 * @property \Telegram\Parts\User $user User who subscribed for payments toward the bot
 * @property string               $invoice_payload Bot-specified invoice payload
 * @property string               $state The new state of the subscription. Currently, it can be one of "canceled" if the user canceled the subscription, "active" if the user re-enabled a previously canceled subscription, or "failed" if payment for the subscription failed.
 *
 * @link https://core.telegram.org/bots/api#botsubscriptionupdated
 *
 * @since v10.3
 */
class BotSubscriptionUpdated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'user',
        'invoice_payload',
        'state',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'user' => 'User',
    ];
}
