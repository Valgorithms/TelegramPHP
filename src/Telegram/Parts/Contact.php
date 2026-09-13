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
 * This object represents a phone contact.
 *
 * @property string      $phone_number Contact's phone number
 * @property string      $first_name Contact's first name
 * @property string|null $last_name Optional. Contact's last name
 * @property int|null    $user_id Optional. Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property string|null $vcard Optional. Additional data about the contact in the form of a vCard
 *
 * @link https://core.telegram.org/bots/api#contact
 *
 * @since Bot API 10.3
 */
class Contact extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'phone_number',
        'first_name',
        'last_name',
        'user_id',
        'vcard',
    ];
}
