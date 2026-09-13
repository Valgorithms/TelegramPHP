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
 * This object represents a sticker.
 *
 * @property string                            $file_id Identifier for this file, which can be used to download or reuse the file
 * @property string                            $file_unique_id Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property string                            $type Type of the sticker, currently one of "regular", "mask", "custom_emoji". The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
 * @property int                               $width Sticker width
 * @property int                               $height Sticker height
 * @property bool                              $is_animated True, if the sticker is animated
 * @property bool                              $is_video True, if the sticker is a video sticker
 * @property \Telegram\Parts\PhotoSize|null    $thumbnail Optional. Sticker thumbnail in the .WEBP or .JPG format
 * @property string|null                       $emoji Optional. Emoji associated with the sticker
 * @property string|null                       $set_name Optional. Name of the sticker set to which the sticker belongs
 * @property \Telegram\Parts\File|null         $premium_animation Optional. For premium regular stickers, premium animation for the sticker
 * @property \Telegram\Parts\MaskPosition|null $mask_position Optional. For mask stickers, the position where the mask should be placed
 * @property string|null                       $custom_emoji_id Optional. For custom emoji stickers, unique identifier of the custom emoji
 * @property bool|null                         $needs_repainting Optional. True, if the sticker must be repainted to a text color in messages, the color of the Telegram Premium badge in emoji status, white color on chat photos, or another appropriate color in other places
 * @property int|null                          $file_size Optional. File size in bytes
 *
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @since Bot API 10.3
 */
class Sticker extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'file_id',
        'file_unique_id',
        'type',
        'width',
        'height',
        'is_animated',
        'is_video',
        'thumbnail',
        'emoji',
        'set_name',
        'premium_animation',
        'mask_position',
        'custom_emoji_id',
        'needs_repainting',
        'file_size',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'thumbnail'         => 'PhotoSize',
        'premium_animation' => 'File',
        'mask_position'     => 'MaskPosition',
    ];
}
