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
 * Gifts and Telegram Premium subscriptions a bot can send, upgrade, transfer, or convert back to
 * Stars.
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
trait GiftApi
{
    /**
     * Converts a given regular gift to Telegram Stars. Requires the can_convert_gifts_to_stars
     * business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be converted to
     *        Telegram Stars
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#convertgifttostars
     */
    public function convertGiftToStars(
        string $business_connection_id,
        string $owned_gift_id,
    ): PromiseInterface {
        return $this->callApi('convertGiftToStars', get_defined_vars(), ['Boolean']);
    }

    /**
     * Returns the list of gifts that can be sent by the bot to users and channel chats. Requires no
     * parameters. Returns a Gifts object.
     *
     * @return PromiseInterface<\Telegram\Parts\Gifts>
     *
     * @link https://core.telegram.org/bots/api#getavailablegifts
     */
    public function getAvailableGifts(): PromiseInterface
    {
        return $this->callApi('getAvailableGifts', [], ['Gifts']);
    }

    /**
     * Returns the gifts received and owned by a managed business account. Requires the
     * can_view_gifts_and_stars business bot right. Returns OwnedGifts on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool|null $exclude_unsaved Optional. Pass True to exclude gifts that aren't saved to the
     *        account's profile page
     * @param bool|null $exclude_saved Optional. Pass True to exclude gifts that are saved to the account's
     *        profile page
     * @param bool|null $exclude_unlimited Optional. Pass True to exclude gifts that can be purchased an
     *        unlimited number of times
     * @param bool|null $exclude_limited_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can be upgraded to unique
     * @param bool|null $exclude_limited_non_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can't be upgraded to unique
     * @param bool|null $exclude_unique Optional. Pass True to exclude unique gifts
     * @param bool|null $exclude_from_blockchain Optional. Pass True to exclude gifts that were assigned
     *        from the TON blockchain and can't be resold or transferred in Telegram
     * @param bool|null $sort_by_price Optional. Pass True to sort results by gift price instead of send
     *        date. Sorting is applied before pagination.
     * @param string|null $offset Optional. Offset of the first entry to return as received from the
     *        previous request; use empty string to get the first chunk of results
     * @param int|null $limit Optional. The maximum number of gifts to be returned; 1-100. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\OwnedGifts>
     *
     * @link https://core.telegram.org/bots/api#getbusinessaccountgifts
     */
    public function getBusinessAccountGifts(
        string $business_connection_id,
        ?bool $exclude_unsaved = null,
        ?bool $exclude_saved = null,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_unique = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getBusinessAccountGifts', get_defined_vars(), ['OwnedGifts']);
    }

    /**
     * Returns the gifts owned by a chat. Returns OwnedGifts on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param bool|null $exclude_unsaved Optional. Pass True to exclude gifts that aren't saved to the
     *        chat's profile page. Always True, unless the bot has the can_post_messages administrator right in
     *        the channel.
     * @param bool|null $exclude_saved Optional. Pass True to exclude gifts that are saved to the chat's
     *        profile page. Always False, unless the bot has the can_post_messages administrator right in the
     *        channel.
     * @param bool|null $exclude_unlimited Optional. Pass True to exclude gifts that can be purchased an
     *        unlimited number of times
     * @param bool|null $exclude_limited_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can be upgraded to unique
     * @param bool|null $exclude_limited_non_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can't be upgraded to unique
     * @param bool|null $exclude_from_blockchain Optional. Pass True to exclude gifts that were assigned
     *        from the TON blockchain and can't be resold or transferred in Telegram
     * @param bool|null $exclude_unique Optional. Pass True to exclude unique gifts
     * @param bool|null $sort_by_price Optional. Pass True to sort results by gift price instead of send
     *        date. Sorting is applied before pagination.
     * @param string|null $offset Optional. Offset of the first entry to return as received from the
     *        previous request; use an empty string to get the first chunk of results
     * @param int|null $limit Optional. The maximum number of gifts to be returned; 1-100. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\OwnedGifts>
     *
     * @link https://core.telegram.org/bots/api#getchatgifts
     */
    public function getChatGifts(
        int|string $chat_id,
        ?bool $exclude_unsaved = null,
        ?bool $exclude_saved = null,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $exclude_unique = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getChatGifts', get_defined_vars(), ['OwnedGifts']);
    }

    /**
     * Returns the gifts owned and hosted by a user. Returns OwnedGifts on success.
     *
     * @param int $user_id Unique identifier of the user
     * @param bool|null $exclude_unlimited Optional. Pass True to exclude gifts that can be purchased an
     *        unlimited number of times
     * @param bool|null $exclude_limited_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can be upgraded to unique
     * @param bool|null $exclude_limited_non_upgradable Optional. Pass True to exclude gifts that can be
     *        purchased a limited number of times and can't be upgraded to unique
     * @param bool|null $exclude_from_blockchain Optional. Pass True to exclude gifts that were assigned
     *        from the TON blockchain and can't be resold or transferred in Telegram
     * @param bool|null $exclude_unique Optional. Pass True to exclude unique gifts
     * @param bool|null $sort_by_price Optional. Pass True to sort results by gift price instead of send
     *        date. Sorting is applied before pagination.
     * @param string|null $offset Optional. Offset of the first entry to return as received from the
     *        previous request; use an empty string to get the first chunk of results
     * @param int|null $limit Optional. The maximum number of gifts to be returned; 1-100. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\OwnedGifts>
     *
     * @link https://core.telegram.org/bots/api#getusergifts
     */
    public function getUserGifts(
        int $user_id,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $exclude_unique = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getUserGifts', get_defined_vars(), ['OwnedGifts']);
    }

    /**
     * Gifts a Telegram Premium subscription to the given user. Returns True on success.
     *
     * @param int $user_id Unique identifier of the target user who will receive a Telegram Premium
     *        subscription
     * @param int $month_count Number of months the Telegram Premium subscription will be active for the
     *        user; must be one of 3, 6, or 12
     * @param int $star_count Number of Telegram Stars to pay for the Telegram Premium subscription; must
     *        be 1000 for 3 months, 1500 for 6 months, and 2500 for 12 months
     * @param string|null $text Optional. Text that will be shown along with the service message about the
     *        subscription; 0-128 characters
     * @param string|null $text_parse_mode Optional. Mode for parsing entities in the text. See formatting
     *        options for more details. Entities other than "bold", "italic", "underline", "strikethrough",
     *        "spoiler", "custom_emoji", and "date_time" are ignored.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $text_entities Optional. A JSON-serialized
     *        list of special entities that appear in the gift text. It can be specified instead of
     *        text_parse_mode. Entities other than "bold", "italic", "underline", "strikethrough", "spoiler",
     *        "custom_emoji", and "date_time" are ignored.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#giftpremiumsubscription
     */
    public function giftPremiumSubscription(
        int $user_id,
        int $month_count,
        int $star_count,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): PromiseInterface {
        return $this->callApi('giftPremiumSubscription', get_defined_vars(), ['Boolean']);
    }

    /**
     * Sends a gift to the given user or channel chat. The gift can't be converted to Telegram Stars by
     * the receiver. Returns True on success.
     *
     * @param string $gift_id Identifier of the gift; limited gifts can't be sent to channel chats
     * @param int|null $user_id Optional. Required if chat_id is not specified. Unique identifier of the
     *        target user who will receive the gift.
     * @param int|string|null $chat_id Optional. Required if user_id is not specified. Unique identifier
     *        for the chat or username of the channel (in the format @username) that will receive the gift.
     * @param bool|null $pay_for_upgrade Optional. Pass True to pay for the gift upgrade from the bot's
     *        balance, thereby making the upgrade free for the receiver
     * @param string|null $text Optional. Text that will be shown along with the gift; 0-128 characters
     * @param string|null $text_parse_mode Optional. Mode for parsing entities in the text. See formatting
     *        options for more details. Entities other than "bold", "italic", "underline", "strikethrough",
     *        "spoiler", "custom_emoji", and "date_time" are ignored.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $text_entities Optional. A JSON-serialized
     *        list of special entities that appear in the gift text. It can be specified instead of
     *        text_parse_mode. Entities other than "bold", "italic", "underline", "strikethrough", "spoiler",
     *        "custom_emoji", and "date_time" are ignored.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#sendgift
     */
    public function sendGift(
        string $gift_id,
        ?int $user_id = null,
        int|string|null $chat_id = null,
        ?bool $pay_for_upgrade = null,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): PromiseInterface {
        return $this->callApi('sendGift', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the privacy settings pertaining to incoming gifts in a managed business account.
     * Requires the can_change_gift_settings business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool $show_gift_button Pass True if a button for sending a gift to the user or by the
     *        business account must always be shown in the input field
     * @param \Telegram\Parts\AcceptedGiftTypes|array $accepted_gift_types Types of gifts accepted by the
     *        business account
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setbusinessaccountgiftsettings
     */
    public function setBusinessAccountGiftSettings(
        string $business_connection_id,
        bool $show_gift_button,
        array|\JsonSerializable $accepted_gift_types,
    ): PromiseInterface {
        return $this->callApi('setBusinessAccountGiftSettings', get_defined_vars(), ['Boolean']);
    }

    /**
     * Transfers an owned unique gift to another user. Requires the can_transfer_and_upgrade_gifts
     * business bot right. Requires can_transfer_stars business bot right if the transfer is paid.
     * Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be transferred
     * @param int $new_owner_chat_id Unique identifier of the chat which will own the gift. The chat must
     *        be active in the last 24 hours.
     * @param int|null $star_count Optional. The amount of Telegram Stars that will be paid for the
     *        transfer from the business account balance. If positive, then the can_transfer_stars business bot
     *        right is required.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#transfergift
     */
    public function transferGift(
        string $business_connection_id,
        string $owned_gift_id,
        int $new_owner_chat_id,
        ?int $star_count = null,
    ): PromiseInterface {
        return $this->callApi('transferGift', get_defined_vars(), ['Boolean']);
    }

    /**
     * Upgrades a given regular gift to a unique gift. Requires the can_transfer_and_upgrade_gifts
     * business bot right. Additionally requires the can_transfer_stars business bot right if the
     * upgrade is paid. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be upgraded to a
     *        unique one
     * @param bool|null $keep_original_details Optional. Pass True to keep the original gift text, sender
     *        and receiver in the upgraded gift
     * @param int|null $star_count Optional. The amount of Telegram Stars that will be paid for the upgrade
     *        from the business account balance. If gift.prepaid_upgrade_star_count > 0, then pass 0, otherwise,
     *        the can_transfer_stars business bot right is required and gift.upgrade_star_count must be passed.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#upgradegift
     */
    public function upgradeGift(
        string $business_connection_id,
        string $owned_gift_id,
        ?bool $keep_original_details = null,
        ?int $star_count = null,
    ): PromiseInterface {
        return $this->callApi('upgradeGift', get_defined_vars(), ['Boolean']);
    }
}
