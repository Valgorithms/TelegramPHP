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
 * A link to an anchor.
 *
 * @property string                   $type Type of the rich text, always "anchor_link"
 * @property \Telegram\Parts\RichText $text The link text
 * @property string                   $anchor_name The name of the anchor. If the name is empty, then the link brings back to the top of the message.
 *
 * @link https://core.telegram.org/bots/api#richtextanchorlink
 *
 * @since v10.3
 */
class RichTextAnchorLink extends RichText
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
        'anchor_name',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
