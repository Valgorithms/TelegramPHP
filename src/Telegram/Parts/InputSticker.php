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
 * This object describes a sticker to be added to a sticker set.
 *
 * @property string                            $sticker The added sticker. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new file using multipart/form-data under <file_attach_name> name. Animated and video stickers can't be uploaded via HTTP URL. More information on Sending Files: https://core.telegram.org/bots/api#sending-files
 * @property string                            $format Format of the added sticker, must be one of "static" for a .WEBP or .PNG image, "animated" for a .TGS animation, "video" for a .WEBM video
 * @property array<int, string>                $emoji_list List of 1-20 emoji associated with the sticker
 * @property \Telegram\Parts\MaskPosition|null $mask_position Optional. Position where the mask should be placed on faces. For "mask" stickers only.
 * @property array<int, string>|null           $keywords Optional. List of 0-20 search keywords for the sticker with total length of up to 64 characters. For "regular" and "custom_emoji" stickers only.
 *
 * @link https://core.telegram.org/bots/api#inputsticker
 *
 * @since v10.3
 */
class InputSticker extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'sticker',
        'format',
        'emoji_list',
        'mask_position',
        'keywords',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'emoji_list'    => 'Array of String',
        'mask_position' => 'MaskPosition',
        'keywords'      => 'Array of String',
    ];
}
