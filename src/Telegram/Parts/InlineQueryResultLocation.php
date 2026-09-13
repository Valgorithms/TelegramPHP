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
 * Represents a location on a map. By default, the location will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content
 * instead of the location.
 *
 * @property string                                    $type Type of the result, must be location
 * @property string                                    $id Unique identifier for this result, 1-64 Bytes
 * @property float                                     $latitude Location latitude in degrees
 * @property float                                     $longitude Location longitude in degrees
 * @property string                                    $title Location title
 * @property float|null                                $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
 * @property int|null                                  $live_period Optional. Period in seconds during which the location can be updated, must be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely
 * @property int|null                                  $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
 * @property int|null                                  $proximity_alert_radius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
 * @property \Telegram\Parts\InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null  $input_message_content Optional. Content of the message to be sent instead of the location
 * @property string|null                               $thumbnail_url Optional. Url of the thumbnail for the result
 * @property int|null                                  $thumbnail_width Optional. Thumbnail width
 * @property int|null                                  $thumbnail_height Optional. Thumbnail height
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @since Bot API 10.3
 */
class InlineQueryResultLocation extends InlineQueryResult
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
        'horizontal_accuracy',
        'live_period',
        'heading',
        'proximity_alert_radius',
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
