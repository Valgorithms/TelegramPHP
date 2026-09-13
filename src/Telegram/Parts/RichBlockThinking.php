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
 * A block with a "Thinking..." placeholder, corresponding to the custom HTML tag <tg-thinking>.
 * The block may be used only in sendRichMessageDraft, therefore it can't be received in messages.
 * See https://t.me/addemoji/AIActions for examples of custom emoji that are recommended for usage
 * in the block.
 *
 * @property string                   $type Type of the block, always "thinking"
 * @property \Telegram\Parts\RichText $text Text of the block. See https://t.me/addemoji/AIActions for examples of custom emoji that are recommended for usage in the block.
 *
 * @link https://core.telegram.org/bots/api#richblockthinking
 *
 * @since Bot API 10.3
 */
class RichBlockThinking extends RichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
