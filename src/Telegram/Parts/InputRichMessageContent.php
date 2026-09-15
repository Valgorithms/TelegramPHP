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
 * Represents the content of a rich message to be sent as the result of an inline query.
 *
 * @property \Telegram\Parts\InputRichMessage $rich_message The message to be sent. Only previously uploaded files may be used in the message.
 *
 * @link https://core.telegram.org/bots/api#inputrichmessagecontent
 *
 * @since v10.3
 */
class InputRichMessageContent extends InputMessageContent
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'rich_message',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'rich_message' => 'InputRichMessage',
    ];
}
