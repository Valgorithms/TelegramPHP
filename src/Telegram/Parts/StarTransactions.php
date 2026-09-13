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
 * Contains a list of Telegram Star transactions.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\StarTransaction> $transactions The list of transactions
 *
 * @link https://core.telegram.org/bots/api#startransactions
 *
 * @since Bot API 10.3
 */
class StarTransactions extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'transactions',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'transactions' => 'Array of StarTransaction',
    ];
}
