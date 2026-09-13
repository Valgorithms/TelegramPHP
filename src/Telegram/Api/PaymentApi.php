<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Api;

use React\Promise\PromiseInterface;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * Invoices, checkout, refunds, and the Telegram Stars balance.
 *
 * Mixed into {@see \Telegram\Telegram} through {@see Methods}. Every method is
 * named exactly as the Bot API names it, takes exactly the fields the Bot API
 * documents (use named arguments for the optional ones), and resolves with the
 * hydrated result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since Bot API 10.3
 */
trait PaymentApi
{
    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final
     * confirmation in the form of an Update with the field pre_checkout_query. Use this method to
     * respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must
     * receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @param string $pre_checkout_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify True if everything is alright (goods are available, etc.) and the bot is
     *        ready to proceed with the order. Use False if there are any problems.
     * @param string|null $error_message Optional. Required if ok is False. Error message in human readable
     *        form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just
     *        bought the last of our amazing black T-shirts while you were busy filling out your payment details.
     *        Please choose a different color or garment!"). Telegram will display this message to the user.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     */
    public function answerPreCheckoutQuery(
        string $pre_checkout_query_id,
        bool $ok,
        ?string $error_message = null,
    ): PromiseInterface {
        return $this->callApi('answerPreCheckoutQuery', get_defined_vars(), ['Boolean']);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was
     * specified, the Bot API will send an Update with a shipping_query field to the bot. Use this
     * method to reply to shipping queries. On success, True is returned.
     *
     * @param string $shipping_query_id Unique identifier for the query to be answered
     * @param bool $ok Pass True if delivery to the specified address is possible and False if there are
     *        any problems (for example, if delivery to the specified address is not possible)
     * @param list<\Telegram\Parts\ShippingOption|array>|null $shipping_options Optional. Required if ok is
     *        True. A JSON-serialized Array of available shipping options.
     * @param string|null $error_message Optional. Required if ok is False. Error message in human readable
     *        form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired
     *        address is unavailable"). Telegram will display this message to the user.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#answershippingquery
     */
    public function answerShippingQuery(
        string $shipping_query_id,
        bool $ok,
        ?array $shipping_options = null,
        ?string $error_message = null,
    ): PromiseInterface {
        return $this->callApi('answerShippingQuery', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to create a link for an invoice. Returns the created invoice link as String on
     * success.
     *
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the
     *        user, use it for your internal processes.
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies. Pass "XTR" for
     *        payments in Telegram Stars.
     * @param list<\Telegram\Parts\LabeledPrice|array> $prices Price breakdown, a JSON-serialized list of
     *        components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.). Must
     *        contain exactly one item for payments in Telegram Stars.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the link will be created. For payments in Telegram Stars only.
     * @param string|null $provider_token Optional. Payment provider token, obtained via @BotFather. Pass
     *        an empty string for payments in Telegram Stars.
     * @param int|null $subscription_period Optional. The number of seconds the subscription will be active
     *        for before the next payment. The currency must be set to "XTR" (Telegram Stars) if the parameter is
     *        used. Currently, it must always be 2592000 (30 days) if specified. Any number of subscriptions can
     *        be active for a given bot at the same time, including multiple concurrent subscriptions from the
     *        same user. Subscription price must no exceed 10000 Telegram Stars.
     * @param int|null $max_tip_amount Optional. The maximum accepted amount for tips in the smallest units
     *        of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass
     *        max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past
     *        the decimal point for each currency (2 for the majority of currencies). Defaults to 0. Not supported
     *        for payments in Telegram Stars.
     * @param list<int>|null $suggested_tip_amounts Optional. A JSON-serialized Array of suggested amounts
     *        of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip
     *        amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased
     *        order and must not exceed max_tip_amount.
     * @param string|null $provider_data Optional. JSON-serialized data about the invoice, which will be
     *        shared with the payment provider. A detailed description of required fields should be provided by
     *        the payment provider.
     * @param string|null $photo_url Optional. URL of the product photo for the invoice. Can be a photo of
     *        the goods or a marketing image for a service.
     * @param int|null $photo_size Optional. Photo size in bytes
     * @param int|null $photo_width Optional. Photo width
     * @param int|null $photo_height Optional. Photo height
     * @param bool|null $need_name Optional. Pass True if you require the user's full name to complete the
     *        order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_phone_number Optional. Pass True if you require the user's phone number to
     *        complete the order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_email Optional. Pass True if you require the user's email address to complete
     *        the order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_shipping_address Optional. Pass True if you require the user's shipping
     *        address to complete the order. Ignored for payments in Telegram Stars.
     * @param bool|null $send_phone_number_to_provider Optional. Pass True if the user's phone number
     *        should be sent to the provider. Ignored for payments in Telegram Stars.
     * @param bool|null $send_email_to_provider Optional. Pass True if the user's email address should be
     *        sent to the provider. Ignored for payments in Telegram Stars.
     * @param bool|null $is_flexible Optional. Pass True if the final price depends on the shipping method.
     *        Ignored for payments in Telegram Stars.
     *
     * @return PromiseInterface<string>
     *
     * @link https://core.telegram.org/bots/api#createinvoicelink
     */
    public function createInvoiceLink(
        string $title,
        string $description,
        string $payload,
        string $currency,
        array $prices,
        ?string $business_connection_id = null,
        ?string $provider_token = null,
        ?int $subscription_period = null,
        ?int $max_tip_amount = null,
        ?array $suggested_tip_amounts = null,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?bool $need_name = null,
        ?bool $need_phone_number = null,
        ?bool $need_email = null,
        ?bool $need_shipping_address = null,
        ?bool $send_phone_number_to_provider = null,
        ?bool $send_email_to_provider = null,
        ?bool $is_flexible = null,
    ): PromiseInterface {
        return $this->callApi('createInvoiceLink', get_defined_vars(), ['String']);
    }

    /**
     * Allows the bot to cancel or re-enable extension of a subscription paid in Telegram Stars.
     * Returns True on success.
     *
     * @param int $user_id Identifier of the user whose subscription will be edited
     * @param string $telegram_payment_charge_id Telegram payment identifier for the subscription
     * @param bool $is_canceled Pass True to cancel extension of the user subscription; the subscription
     *        must be active up to the end of the current subscription period. Pass False to allow the user to
     *        re-enable a subscription that was previously canceled by the bot.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#edituserstarsubscription
     */
    public function editUserStarSubscription(
        int $user_id,
        string $telegram_payment_charge_id,
        bool $is_canceled,
    ): PromiseInterface {
        return $this->callApi('editUserStarSubscription', get_defined_vars(), ['Boolean']);
    }

    /**
     * A method to get the current Telegram Stars balance of the bot. Requires no parameters. On
     * success, returns a StarAmount object.
     *
     * @return PromiseInterface<\Telegram\Parts\StarAmount>
     *
     * @link https://core.telegram.org/bots/api#getmystarbalance
     */
    public function getMyStarBalance(): PromiseInterface
    {
        return $this->callApi('getMyStarBalance', [], ['StarAmount']);
    }

    /**
     * Returns the bot's Telegram Star transactions in chronological order. On success, returns a
     * StarTransactions object.
     *
     * @param int|null $offset Optional. Number of transactions to skip in the response
     * @param int|null $limit Optional. The maximum number of transactions to be retrieved. Values between
     *        1-100 are accepted. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\StarTransactions>
     *
     * @link https://core.telegram.org/bots/api#getstartransactions
     */
    public function getStarTransactions(
        ?int $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getStarTransactions', get_defined_vars(), ['StarTransactions']);
    }

    /**
     * Refunds a successful payment in Telegram Stars. Returns True on success.
     *
     * @param int $user_id Identifier of the user whose payment will be refunded
     * @param string $telegram_payment_charge_id Telegram payment identifier
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#refundstarpayment
     */
    public function refundStarPayment(
        int $user_id,
        string $telegram_payment_charge_id,
    ): PromiseInterface {
        return $this->callApi('refundStarPayment', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send invoices. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the
     *        user, use it for your internal processes.
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies. Pass "XTR" for
     *        payments in Telegram Stars.
     * @param list<\Telegram\Parts\LabeledPrice|array> $prices Price breakdown, a JSON-serialized list of
     *        components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.). Must
     *        contain exactly one item for payments in Telegram Stars.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param string|null $provider_token Optional. Payment provider token, obtained via @BotFather. Pass
     *        an empty string for payments in Telegram Stars.
     * @param int|null $max_tip_amount Optional. The maximum accepted amount for tips in the smallest units
     *        of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass
     *        max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past
     *        the decimal point for each currency (2 for the majority of currencies). Defaults to 0. Not supported
     *        for payments in Telegram Stars.
     * @param list<int>|null $suggested_tip_amounts Optional. A JSON-serialized Array of suggested amounts
     *        of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip
     *        amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased
     *        order and must not exceed max_tip_amount.
     * @param string|null $start_parameter Optional. Unique deep-linking parameter. If left empty,
     *        forwarded copies of the sent message will have a Pay button, allowing multiple users to pay directly
     *        from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent
     *        message will have a URL button with a deep link to the bot (instead of a Pay button), with the value
     *        used as the start parameter.
     * @param string|null $provider_data Optional. JSON-serialized data about the invoice, which will be
     *        shared with the payment provider. A detailed description of required fields should be provided by
     *        the payment provider.
     * @param string|null $photo_url Optional. URL of the product photo for the invoice. Can be a photo of
     *        the goods or a marketing image for a service. People like it better when they see what they are
     *        paying for.
     * @param int|null $photo_size Optional. Photo size in bytes
     * @param int|null $photo_width Optional. Photo width
     * @param int|null $photo_height Optional. Photo height
     * @param bool|null $need_name Optional. Pass True if you require the user's full name to complete the
     *        order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_phone_number Optional. Pass True if you require the user's phone number to
     *        complete the order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_email Optional. Pass True if you require the user's email address to complete
     *        the order. Ignored for payments in Telegram Stars.
     * @param bool|null $need_shipping_address Optional. Pass True if you require the user's shipping
     *        address to complete the order. Ignored for payments in Telegram Stars.
     * @param bool|null $send_phone_number_to_provider Optional. Pass True if the user's phone number
     *        should be sent to the provider. Ignored for payments in Telegram Stars.
     * @param bool|null $send_email_to_provider Optional. Pass True if the user's email address should be
     *        sent to the provider. Ignored for payments in Telegram Stars.
     * @param bool|null $is_flexible Optional. Pass True if the final price depends on the shipping method.
     *        Ignored for payments in Telegram Stars.
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding and saving
     * @param bool|null $allow_paid_broadcast Optional. Pass True to allow up to 1000 messages per second,
     *        ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be
     *        withdrawn from the bot's balance.
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message; for private chats only
     * @param \Telegram\Parts\SuggestedPostParameters|array|null $suggested_post_parameters Optional. A
     *        JSON-serialized object containing the parameters of the suggested post to send; for direct messages
     *        chats only. If the message is sent as a reply to another suggested post, then that suggested post is
     *        automatically declined.
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. Description of the
     *        message to reply to
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty,
     *        the first button must be a Pay button.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendinvoice
     */
    public function sendInvoice(
        int|string $chat_id,
        string $title,
        string $description,
        string $payload,
        string $currency,
        array $prices,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $provider_token = null,
        ?int $max_tip_amount = null,
        ?array $suggested_tip_amounts = null,
        ?string $start_parameter = null,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?bool $need_name = null,
        ?bool $need_phone_number = null,
        ?bool $need_email = null,
        ?bool $need_shipping_address = null,
        ?bool $send_phone_number_to_provider = null,
        ?bool $send_email_to_provider = null,
        ?bool $is_flexible = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendInvoice', get_defined_vars(), ['Message']);
    }
}
