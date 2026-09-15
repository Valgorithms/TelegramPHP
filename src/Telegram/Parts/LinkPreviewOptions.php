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
 * Describes the options used for link preview generation.
 *
 * @property bool|null   $is_disabled Optional. True, if the link preview is disabled
 * @property string|null $url Optional. URL to use for the link preview. If empty, then the first URL found in the message text will be used.
 * @property bool|null   $prefer_small_media Optional. True, if the media in the link preview is supposed to be shrunk; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview
 * @property bool|null   $prefer_large_media Optional. True, if the media in the link preview is supposed to be enlarged; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview
 * @property bool|null   $show_above_text Optional. True, if the link preview must be shown above the message text; otherwise, the link preview will be shown below the message text
 *
 * @link https://core.telegram.org/bots/api#linkpreviewoptions
 *
 * @since v10.3
 */
class LinkPreviewOptions extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'is_disabled',
        'url',
        'prefer_small_media',
        'prefer_large_media',
        'show_above_text',
    ];
}
