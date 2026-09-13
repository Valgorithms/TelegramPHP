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
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * @property string                                                          $message_text Text of the message to be sent, 1-4096 characters
 * @property string|null                                                     $parse_mode Optional. Mode for parsing entities in the message text. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. List of special entities that appear in message text, which can be specified instead of parse_mode
 * @property \Telegram\Parts\LinkPreviewOptions|null                         $link_preview_options Optional. Link preview generation options for the message
 *
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 *
 * @since Bot API 10.3
 */
class InputTextMessageContent extends InputMessageContent
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'message_text',
        'parse_mode',
        'entities',
        'link_preview_options',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'entities'             => 'Array of MessageEntity',
        'link_preview_options' => 'LinkPreviewOptions',
    ];
}
