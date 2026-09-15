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
 * This object describes the state of a revenue withdrawal operation. Currently, it can be one of
 * - RevenueWithdrawalStatePending
 * - RevenueWithdrawalStateSucceeded
 * - RevenueWithdrawalStateFailed
 *
 * One of: RevenueWithdrawalStatePending, RevenueWithdrawalStateSucceeded, RevenueWithdrawalStateFailed.
 *
 * @link https://core.telegram.org/bots/api#revenuewithdrawalstate
 *
 * @since v10.3
 */
abstract class RevenueWithdrawalState extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'pending'   => RevenueWithdrawalStatePending::class,
        'succeeded' => RevenueWithdrawalStateSucceeded::class,
        'failed'    => RevenueWithdrawalStateFailed::class,
    ];
}
