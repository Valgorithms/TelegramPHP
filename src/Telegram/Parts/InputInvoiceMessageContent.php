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
 * Represents the content of an invoice message to be sent as the result of an inline query.
 *
 * @property string                                                    $title Product name, 1-32 characters
 * @property string                                                    $description Product description, 1-255 characters
 * @property string                                                    $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use it for your internal processes.
 * @property string|null                                               $provider_token Optional. Payment provider token, obtained via @BotFather. Pass an empty string for payments in Telegram Stars.
 * @property string                                                    $currency Three-letter ISO 4217 currency code, see more on currencies. Pass "XTR" for payments in Telegram Stars.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\LabeledPrice> $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.). Must contain exactly one item for payments in Telegram Stars.
 * @property int|null                                                  $max_tip_amount Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0. Not supported for payments in Telegram Stars.
 * @property array<int, int>|null                                      $suggested_tip_amounts Optional. A JSON-serialized Array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
 * @property string|null                                               $provider_data Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider.
 * @property string|null                                               $photo_url Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
 * @property int|null                                                  $photo_size Optional. Photo size in bytes
 * @property int|null                                                  $photo_width Optional. Photo width
 * @property int|null                                                  $photo_height Optional. Photo height
 * @property bool|null                                                 $need_name Optional. Pass True if you require the user's full name to complete the order. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $need_phone_number Optional. Pass True if you require the user's phone number to complete the order. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $need_email Optional. Pass True if you require the user's email address to complete the order. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $need_shipping_address Optional. Pass True if you require the user's shipping address to complete the order. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $send_phone_number_to_provider Optional. Pass True if the user's phone number should be sent to the provider. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $send_email_to_provider Optional. Pass True if the user's email address should be sent to the provider. Ignored for payments in Telegram Stars.
 * @property bool|null                                                 $is_flexible Optional. Pass True if the final price depends on the shipping method. Ignored for payments in Telegram Stars.
 *
 * @link https://core.telegram.org/bots/api#inputinvoicemessagecontent
 *
 * @since Bot API 10.3
 */
class InputInvoiceMessageContent extends InputMessageContent
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'title',
        'description',
        'payload',
        'provider_token',
        'currency',
        'prices',
        'max_tip_amount',
        'suggested_tip_amounts',
        'provider_data',
        'photo_url',
        'photo_size',
        'photo_width',
        'photo_height',
        'need_name',
        'need_phone_number',
        'need_email',
        'need_shipping_address',
        'send_phone_number_to_provider',
        'send_email_to_provider',
        'is_flexible',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'prices'                => 'Array of LabeledPrice',
        'suggested_tip_amounts' => 'Array of Integer',
    ];
}
