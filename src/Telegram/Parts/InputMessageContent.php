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
 * This object represents the content of a message to be sent as a result of an inline query.
 * Telegram clients currently support the following types:
 * - InputTextMessageContent
 * - InputRichMessageContent
 * - InputLocationMessageContent
 * - InputVenueMessageContent
 * - InputContactMessageContent
 * - InputInvoiceMessageContent
 *
 * One of: InputTextMessageContent, InputRichMessageContent, InputLocationMessageContent, InputVenueMessageContent, InputContactMessageContent, InputInvoiceMessageContent.
 *
 * @link https://core.telegram.org/bots/api#inputmessagecontent
 *
 * @since v10.3
 */
abstract class InputMessageContent extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        InputTextMessageContent::class,
        InputRichMessageContent::class,
        InputLocationMessageContent::class,
        InputVenueMessageContent::class,
        InputContactMessageContent::class,
        InputInvoiceMessageContent::class,
    ];
}
