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
 * At most one of the optional fields can be present in any given object.
 *
 * @property \Telegram\Parts\Animation|null                              $animation Optional. Media is an animation, information about the animation
 * @property \Telegram\Parts\Audio|null                                  $audio Optional. Media is an audio file, information about the file; currently, can't be received in a poll option
 * @property \Telegram\Parts\Document|null                               $document Optional. Media is a general file, information about the file; currently, can't be received in a poll option
 * @property \Telegram\Parts\Link|null                                   $link Optional. The HTTP link attached to the poll option
 * @property \Telegram\Parts\LivePhoto|null                              $live_photo Optional. Media is a live photo, information about the live photo
 * @property \Telegram\Parts\Location|null                               $location Optional. Media is a shared location, information about the location
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null $photo Optional. Media is a photo, available sizes of the photo
 * @property \Telegram\Parts\Sticker|null                                $sticker Optional. Media is a sticker, information about the sticker; currently, for poll options only
 * @property \Telegram\Parts\Venue|null                                  $venue Optional. Media is a venue, information about the venue
 * @property \Telegram\Parts\Video|null                                  $video Optional. Media is a video, information about the video
 *
 * @link https://core.telegram.org/bots/api#pollmedia
 *
 * @since v10.3
 */
class PollMedia extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'animation',
        'audio',
        'document',
        'link',
        'live_photo',
        'location',
        'photo',
        'sticker',
        'venue',
        'video',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'animation'  => 'Animation',
        'audio'      => 'Audio',
        'document'   => 'Document',
        'link'       => 'Link',
        'live_photo' => 'LivePhoto',
        'location'   => 'Location',
        'photo'      => 'Array of PhotoSize',
        'sticker'    => 'Sticker',
        'venue'      => 'Venue',
        'video'      => 'Video',
    ];
}
