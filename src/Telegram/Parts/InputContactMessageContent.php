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
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @property string      $phone_number Contact's phone number
 * @property string      $first_name Contact's first name
 * @property string|null $last_name Optional. Contact's last name
 * @property string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
 *
 * @link https://core.telegram.org/bots/api#inputcontactmessagecontent
 *
 * @since v10.3
 */
class InputContactMessageContent extends InputMessageContent
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'phone_number',
        'first_name',
        'last_name',
        'vcard',
    ];
}
