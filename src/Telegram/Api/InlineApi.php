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
 * Inline mode, callback queries, and Mini App queries - everything the bot answers rather than
 * initiates.
 *
 * Mixed into {@see \Telegram\Telegram} through {@see Methods}. Every method is
 * named exactly as the Bot API names it, takes exactly the fields the Bot API
 * documents (use named arguments for the optional ones), and resolves with the
 * hydrated result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since v10.3
 */
trait InlineApi
{
    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will
     * be displayed to the user as a notification at the top of the chat screen or as an alert. On
     * success, True is returned.
     *
     * @param string $callback_query_id Unique identifier for the query to be answered
     * @param string|null $text Optional. Text of the notification. If not specified, nothing will be shown
     *        to the user, 0-200 characters.
     * @param bool|null $show_alert Optional. If True, an alert will be shown by the client instead of a
     *        notification at the top of the chat screen. Defaults to False.
     * @param string|null $url Optional. URL that will be opened by the user's client. If you have created
     *        a Game and accepted the conditions via @BotFather, specify the URL that opens your game - note that
     *        this will only work if the query comes from a callback_game button. Otherwise, you may use links
     *        like t.me/your_bot?start=XXXX that open your bot with a parameter.
     * @param int|null $cache_time Optional. The maximum amount of time in seconds that the result of the
     *        callback query may be cached client-side. Defaults to 0.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     */
    public function answerCallbackQuery(
        string $callback_query_id,
        ?string $text = null,
        ?bool $show_alert = null,
        ?string $url = null,
        ?int $cache_time = null,
    ): PromiseInterface {
        return $this->callApi('answerCallbackQuery', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to reply to a received guest message. On success, a SentGuestMessage object is
     * returned.
     *
     * @param string $guest_query_id Unique identifier for the query to be answered
     * @param \Telegram\Parts\InlineQueryResult|array $result A JSON-serialized object describing the
     *        message to be sent
     *
     * @return PromiseInterface<\Telegram\Parts\SentGuestMessage>
     *
     * @link https://core.telegram.org/bots/api#answerguestquery
     */
    public function answerGuestQuery(
        string $guest_query_id,
        array|\JsonSerializable $result,
    ): PromiseInterface {
        return $this->callApi('answerGuestQuery', get_defined_vars(), ['SentGuestMessage']);
    }

    /**
     * Use this method to send answers to an inline query. On success, True is returned.
     * No more than 50 results per query are allowed.
     *
     * @param string $inline_query_id Unique identifier for the answered query
     * @param list<\Telegram\Parts\InlineQueryResult|array> $results A JSON-serialized Array of results for
     *        the inline query
     * @param int|null $cache_time Optional. The maximum amount of time in seconds that the result of the
     *        inline query may be cached on the server. Defaults to 300.
     * @param bool|null $is_personal Optional. Pass True if results may be cached on the server side only
     *        for the user that sent the query. By default, results may be returned to any user who sends the same
     *        query.
     * @param string|null $next_offset Optional. Pass the offset that a client should send in the next
     *        query with the same text to receive more results. Pass an empty string if there are no more results
     *        or if you don't support pagination. Offset length can't exceed 64 bytes.
     * @param \Telegram\Parts\InlineQueryResultsButton|array|null $button Optional. A JSON-serialized
     *        object describing a button to be shown above inline query results
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     */
    public function answerInlineQuery(
        string $inline_query_id,
        array $results,
        ?int $cache_time = null,
        ?bool $is_personal = null,
        ?string $next_offset = null,
        array|\JsonSerializable|null $button = null,
    ): PromiseInterface {
        return $this->callApi('answerInlineQuery', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set the result of an interaction with a Web App and send a corresponding
     * message on behalf of the user to the chat from which the query originated. On success, a
     * SentWebAppMessage object is returned.
     *
     * @param string $web_app_query_id Unique identifier for the query to be answered
     * @param \Telegram\Parts\InlineQueryResult|array $result A JSON-serialized object describing the
     *        message to be sent
     *
     * @return PromiseInterface<\Telegram\Parts\SentWebAppMessage>
     *
     * @link https://core.telegram.org/bots/api#answerwebappquery
     */
    public function answerWebAppQuery(
        string $web_app_query_id,
        array|\JsonSerializable $result,
    ): PromiseInterface {
        return $this->callApi('answerWebAppQuery', get_defined_vars(), ['SentWebAppMessage']);
    }

    /**
     * Stores a message that can be sent by a user of a Mini App. Returns a PreparedInlineMessage
     * object.
     *
     * @param int $user_id Unique identifier of the target user that can use the prepared message
     * @param \Telegram\Parts\InlineQueryResult|array $result A JSON-serialized object describing the
     *        message to be sent
     * @param bool|null $allow_user_chats Optional. Pass True if the message can be sent to private chats
     *        with users
     * @param bool|null $allow_bot_chats Optional. Pass True if the message can be sent to private chats
     *        with bots
     * @param bool|null $allow_group_chats Optional. Pass True if the message can be sent to group and
     *        supergroup chats
     * @param bool|null $allow_channel_chats Optional. Pass True if the message can be sent to channel
     *        chats
     *
     * @return PromiseInterface<\Telegram\Parts\PreparedInlineMessage>
     *
     * @link https://core.telegram.org/bots/api#savepreparedinlinemessage
     */
    public function savePreparedInlineMessage(
        int $user_id,
        array|\JsonSerializable $result,
        ?bool $allow_user_chats = null,
        ?bool $allow_bot_chats = null,
        ?bool $allow_group_chats = null,
        ?bool $allow_channel_chats = null,
    ): PromiseInterface {
        return $this->callApi('savePreparedInlineMessage', get_defined_vars(), ['PreparedInlineMessage']);
    }

    /**
     * Stores a keyboard button that can be used by a user within a Mini App. Returns a
     * PreparedKeyboardButton object.
     *
     * @param int $user_id Unique identifier of the target user that can use the button
     * @param \Telegram\Parts\KeyboardButton|array $button A JSON-serialized object describing the button
     *        to be saved. The button must be of the type request_users, request_chat, or request_managed_bot.
     *
     * @return PromiseInterface<\Telegram\Parts\PreparedKeyboardButton>
     *
     * @link https://core.telegram.org/bots/api#savepreparedkeyboardbutton
     */
    public function savePreparedKeyboardButton(
        int $user_id,
        array|\JsonSerializable $button,
    ): PromiseInterface {
        return $this->callApi('savePreparedKeyboardButton', get_defined_vars(), ['PreparedKeyboardButton']);
    }

    /**
     * Use this method to process a received chat join request query by showing a Mini App to the user
     * before deciding the outcome. Call answerChatJoinRequestQuery to resolve the join request query
     * based on the user interaction with the Mini App. Returns True on success.
     *
     * @param string $chat_join_request_query_id Unique identifier of the join request query
     * @param string $web_app_url An HTTPS URL of a Web App to be opened with additional data as specified
     *        in Initializing Web Apps
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#sendchatjoinrequestwebapp
     */
    public function sendChatJoinRequestWebApp(
        string $chat_join_request_query_id,
        string $web_app_url,
    ): PromiseInterface {
        return $this->callApi('sendChatJoinRequestWebApp', get_defined_vars(), ['Boolean']);
    }
}
