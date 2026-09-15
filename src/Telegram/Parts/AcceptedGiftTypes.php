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
 * This object describes the types of gifts that can be gifted to a user or a chat.
 *
 * @property bool $unlimited_gifts True, if unlimited regular gifts are accepted
 * @property bool $limited_gifts True, if limited regular gifts are accepted
 * @property bool $unique_gifts True, if unique gifts or gifts that can be upgraded to unique for free are accepted
 * @property bool $premium_subscription True, if a Telegram Premium subscription is accepted
 * @property bool $gifts_from_channels True, if transfers of unique gifts from channels are accepted
 *
 * @link https://core.telegram.org/bots/api#acceptedgifttypes
 *
 * @since v10.3
 */
class AcceptedGiftTypes extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'unlimited_gifts',
        'limited_gifts',
        'unique_gifts',
        'premium_subscription',
        'gifts_from_channels',
    ];
}
