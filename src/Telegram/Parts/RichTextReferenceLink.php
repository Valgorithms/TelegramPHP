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
 * A link to a reference.
 *
 * @property string                   $type Type of the rich text, always "reference_link"
 * @property \Telegram\Parts\RichText $text The link text
 * @property string                   $reference_name The name of the reference
 *
 * @link https://core.telegram.org/bots/api#richtextreferencelink
 *
 * @since Bot API 10.3
 */
class RichTextReferenceLink extends RichText
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
        'reference_name',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
