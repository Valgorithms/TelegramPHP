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
 * The withdrawal succeeded.
 *
 * @property string                  $type Type of the state, always "succeeded"
 * @property \Carbon\CarbonImmutable $date Date the withdrawal was completed in Unix time
 * @property string                  $url An HTTPS URL that can be used to see transaction details
 *
 * @link https://core.telegram.org/bots/api#revenuewithdrawalstatesucceeded
 *
 * @since v10.3
 */
class RevenueWithdrawalStateSucceeded extends RevenueWithdrawalState
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'date',
        'url',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
    ];
}
