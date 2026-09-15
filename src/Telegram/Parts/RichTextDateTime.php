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
 * Formatted date and time.
 *
 * @property string                   $type Type of the rich text, always "date_time"
 * @property \Telegram\Parts\RichText $text The text
 * @property int                      $unix_time The Unix time associated with the entity
 * @property string                   $date_time_format The string that defines the formatting of the date and time. See date-time entity formatting for more details.
 *
 * @link https://core.telegram.org/bots/api#richtextdatetime
 *
 * @since v10.3
 */
class RichTextDateTime extends RichText
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'text',
        'unix_time',
        'date_time_format',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'text' => 'RichText',
    ];
}
