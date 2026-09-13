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
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the venue.
 *
 * @property string                                    $type Type of the result, must be venue
 * @property string                                    $id Unique identifier for this result, 1-64 Bytes
 * @property float                                     $latitude Latitude of the venue location in degrees
 * @property float                                     $longitude Longitude of the venue location in degrees
 * @property string                                    $title Title of the venue
 * @property string                                    $address Address of the venue
 * @property string|null                               $foursquare_id Optional. Foursquare identifier of the venue if known
 * @property string|null                               $foursquare_type Optional. Foursquare type of the venue, if known. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
 * @property string|null                               $google_place_id Optional. Google Places identifier of the venue
 * @property string|null                               $google_place_type Optional. Google Places type of the venue. (See supported types.)
 * @property \Telegram\Parts\InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null  $input_message_content Optional. Content of the message to be sent instead of the venue
 * @property string|null                               $thumbnail_url Optional. Url of the thumbnail for the result
 * @property int|null                                  $thumbnail_width Optional. Thumbnail width
 * @property int|null                                  $thumbnail_height Optional. Thumbnail height
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @since Bot API 10.3
 */
class InlineQueryResultVenue extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'latitude',
        'longitude',
        'title',
        'address',
        'foursquare_id',
        'foursquare_type',
        'google_place_id',
        'google_place_type',
        'reply_markup',
        'input_message_content',
        'thumbnail_url',
        'thumbnail_width',
        'thumbnail_height',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'reply_markup'          => 'InlineKeyboardMarkup',
        'input_message_content' => 'InputMessageContent',
    ];
}
