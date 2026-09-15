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
 * Describes a Telegram Star transaction. Note that if the buyer initiates a chargeback with the
 * payment provider from whom they acquired Stars (e.g., Apple, Google) following this transaction,
 * the refunded Stars will be deducted from the bot's balance. This is outside of Telegram's
 * control.
 *
 * @property string                                  $id Unique identifier of the transaction. Coincides with the identifier of the original transaction for refund transactions. Coincides with SuccessfulPayment.telegram_payment_charge_id for successful incoming payments from users.
 * @property int                                     $amount Integer amount of Telegram Stars transferred by the transaction
 * @property int|null                                $nanostar_amount Optional. The number of 1/1000000000 shares of Telegram Stars transferred by the transaction; from 0 to 999999999
 * @property \Carbon\CarbonImmutable                 $date Date the transaction was created in Unix time
 * @property \Telegram\Parts\TransactionPartner|null $source Optional. Source of an incoming transaction (e.g., a user purchasing goods or services, Fragment refunding a failed withdrawal). Only for incoming transactions.
 * @property \Telegram\Parts\TransactionPartner|null $receiver Optional. Receiver of an outgoing transaction (e.g., a user for a purchase refund, Fragment for a withdrawal). Only for outgoing transactions.
 *
 * @link https://core.telegram.org/bots/api#startransaction
 *
 * @since v10.3
 */
class StarTransaction extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'amount',
        'nanostar_amount',
        'date',
        'source',
        'receiver',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'source'   => 'TransactionPartner',
        'receiver' => 'TransactionPartner',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
