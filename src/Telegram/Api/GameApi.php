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
 * HTML5 games and their high-score tables.
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
trait GameApi
{
    /**
     * Use this method to get data for high score tables. Will return the score of the specified user
     * and several of their neighbors in a game. Returns an Array of GameHighScore objects.
     *
     * @param int $user_id Target user id
     * @param int|null $chat_id Optional. Required if inline_message_id is not specified. Unique identifier
     *        for the target chat.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the sent message.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\GameHighScore>>
     *
     * @link https://core.telegram.org/bots/api#getgamehighscores
     */
    public function getGameHighScores(
        int $user_id,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): PromiseInterface {
        return $this->callApi('getGameHighScores', get_defined_vars(), ['Array of GameHighScore']);
    }

    /**
     * Use this method to send a game. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot in
     *        the format @username. Games can't be sent to channel direct messages chats and channel chats.
     * @param string $game_short_name Short name of the game, serves as the unique identifier for the game.
     *        Set up your games via @BotFather.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding and saving
     * @param bool|null $allow_paid_broadcast Optional. Pass True to allow up to 1000 messages per second,
     *        ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be
     *        withdrawn from the bot's balance.
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message; for private chats only
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. Description of the
     *        message to reply to
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard. If empty, one 'Play game_title' button will be shown. If not empty,
     *        the first button must launch the game.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendgame
     */
    public function sendGame(
        int|string $chat_id,
        string $game_short_name,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendGame', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to set the score of the specified user in a game message. On success, if the
     * message is not an inline message, the Message is returned, otherwise True is returned. Returns
     * an error, if the new score is not greater than the user's current score in the chat and force is
     * False.
     *
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Optional. Pass True if the high score is allowed to decrease. This can be
     *        useful when fixing mistakes or banning cheaters.
     * @param bool|null $disable_edit_message Optional. Pass True if the game message should not be
     *        automatically edited to include the current scoreboard
     * @param int|null $chat_id Optional. Required if inline_message_id is not specified. Unique identifier
     *        for the target chat.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the sent message.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#setgamescore
     */
    public function setGameScore(
        int $user_id,
        int $score,
        ?bool $force = null,
        ?bool $disable_edit_message = null,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): PromiseInterface {
        return $this->callApi('setGameScore', get_defined_vars(), ['Message', 'Boolean']);
    }
}
