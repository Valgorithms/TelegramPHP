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
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @property float       $latitude Latitude of the venue in degrees
 * @property float       $longitude Longitude of the venue in degrees
 * @property string      $title Name of the venue
 * @property string      $address Address of the venue
 * @property string|null $foursquare_id Optional. Foursquare identifier of the venue, if known
 * @property string|null $foursquare_type Optional. Foursquare type of the venue, if known. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
 * @property string|null $google_place_id Optional. Google Places identifier of the venue
 * @property string|null $google_place_type Optional. Google Places type of the venue. (See supported types.)
 *
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @since Bot API 10.3
 */
class InputVenueMessageContent extends InputMessageContent
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'latitude',
        'longitude',
        'title',
        'address',
        'foursquare_id',
        'foursquare_type',
        'google_place_id',
        'google_place_type',
    ];
}
