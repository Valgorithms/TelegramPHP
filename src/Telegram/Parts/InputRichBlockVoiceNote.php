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
 * A block with a voice note, corresponding to the HTML tag <audio>.
 *
 * @property string                                $type Type of the block, always "voice_note"
 * @property \Telegram\Parts\InputMediaVoiceNote   $voice_note The voice note. Caption is ignored.
 * @property \Telegram\Parts\RichBlockCaption|null $caption Optional. Caption of the block
 *
 * @link https://core.telegram.org/bots/api#inputrichblockvoicenote
 *
 * @since Bot API 10.3
 */
class InputRichBlockVoiceNote extends InputRichBlock
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'voice_note',
        'caption',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'voice_note' => 'InputMediaVoiceNote',
        'caption'    => 'RichBlockCaption',
    ];
}
