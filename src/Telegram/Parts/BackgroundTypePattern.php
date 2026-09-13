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
 * The background is a .PNG or .TGV (gzipped subset of SVG with MIME type
 * "application/x-tgwallpattern") pattern to be combined with the background fill chosen by the
 * user.
 *
 * @property string                         $type Type of the background, always "pattern"
 * @property \Telegram\Parts\Document       $document Document with the pattern
 * @property \Telegram\Parts\BackgroundFill $fill The background fill that is combined with the pattern
 * @property int                            $intensity Intensity of the pattern when it is shown above the filled background; 0-100
 * @property bool|null                      $is_inverted Optional. True, if the background fill must be applied only to the pattern itself. All other pixels are black in this case. For dark themes only.
 * @property bool|null                      $is_moving Optional. True, if the background moves slightly when the device is tilted
 *
 * @link https://core.telegram.org/bots/api#backgroundtypepattern
 *
 * @since Bot API 10.3
 */
class BackgroundTypePattern extends BackgroundType
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'document',
        'fill',
        'intensity',
        'is_inverted',
        'is_moving',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'document' => 'Document',
        'fill'     => 'BackgroundFill',
    ];
}
