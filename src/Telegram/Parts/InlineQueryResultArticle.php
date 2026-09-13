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
 * Represents a link to an article or web page.
 *
 * @property string                                    $type Type of the result, must be article
 * @property string                                    $id Unique identifier for this result, 1-64 Bytes
 * @property string                                    $title Title of the result
 * @property \Telegram\Parts\InputMessageContent       $input_message_content Content of the message to be sent
 * @property \Telegram\Parts\InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 * @property string|null                               $url Optional. URL of the result
 * @property string|null                               $description Optional. Short description of the result
 * @property string|null                               $thumbnail_url Optional. Url of the thumbnail for the result
 * @property int|null                                  $thumbnail_width Optional. Thumbnail width
 * @property int|null                                  $thumbnail_height Optional. Thumbnail height
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @since Bot API 10.3
 */
class InlineQueryResultArticle extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'title',
        'input_message_content',
        'reply_markup',
        'url',
        'description',
        'thumbnail_url',
        'thumbnail_width',
        'thumbnail_height',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'input_message_content' => 'InputMessageContent',
        'reply_markup'          => 'InlineKeyboardMarkup',
    ];
}
