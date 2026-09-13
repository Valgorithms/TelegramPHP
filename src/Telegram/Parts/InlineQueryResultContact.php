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
 * Represents a contact with a phone number. By default, this contact will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content
 * instead of the contact.
 *
 * @property string                                    $type Type of the result, must be contact
 * @property string                                    $id Unique identifier for this result, 1-64 Bytes
 * @property string                                    $phone_number Contact's phone number
 * @property string                                    $first_name Contact's first name
 * @property string|null                               $last_name Optional. Contact's last name
 * @property string|null                               $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
 * @property \Telegram\Parts\InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 * @property \Telegram\Parts\InputMessageContent|null  $input_message_content Optional. Content of the message to be sent instead of the contact
 * @property string|null                               $thumbnail_url Optional. Url of the thumbnail for the result
 * @property int|null                                  $thumbnail_width Optional. Thumbnail width
 * @property int|null                                  $thumbnail_height Optional. Thumbnail height
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @since Bot API 10.3
 */
class InlineQueryResultContact extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'phone_number',
        'first_name',
        'last_name',
        'vcard',
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
