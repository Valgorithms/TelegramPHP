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
 * This object represents a service message about the creation of a scheduled giveaway.
 *
 * @property int|null $prize_star_count Optional. The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only
 *
 * @link https://core.telegram.org/bots/api#giveawaycreated
 *
 * @since v10.3
 */
class GiveawayCreated extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'prize_star_count',
    ];
}
