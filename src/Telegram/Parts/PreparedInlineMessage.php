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
 * Describes an inline message to be sent by a user of a Mini App.
 *
 * @property string                  $id Unique identifier of the prepared message
 * @property \Carbon\CarbonImmutable $expiration_date Expiration date of the prepared message, in Unix time. Expired prepared messages can no longer be used.
 *
 * @link https://core.telegram.org/bots/api#preparedinlinemessage
 *
 * @since Bot API 10.3
 */
class PreparedInlineMessage extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'expiration_date',
    ];

    /** @var list<string> */
    protected array $dates = [
        'expiration_date',
    ];
}
