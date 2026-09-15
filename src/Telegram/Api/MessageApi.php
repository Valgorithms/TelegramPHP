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
 * Sending, editing, forwarding, reacting to, pinning, and deleting messages of every media type.
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
trait MessageApi
{
    /**
     * Use this method to copy messages of any kind. Service messages, paid media messages, giveaway
     * messages, giveaway winners messages, and invoice messages can't be copied. A quiz poll can be
     * copied only if the value of the field correct_option_ids is known to the bot. The method is
     * analogous to the method forwardMessage, but the copied message doesn't have a link to the
     * original message. Returns the MessageId of the sent message on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent
     *        (or username of the target bot, supergroup or channel in the format @username)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param int|null $video_start_timestamp Optional. New start timestamp for the copied video in the
     *        message
     * @param string|null $caption Optional. New caption for media, 0-1024 characters after entities
     *        parsing. If not specified, the original caption is kept.
     * @param string|null $parse_mode Optional. Mode for parsing entities in the new caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the new caption, which can be specified instead of
     *        parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media. Ignored if a new caption isn't specified.
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding and saving
     * @param bool|null $allow_paid_broadcast Optional. Pass True to allow up to 1000 messages per second,
     *        ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be
     *        withdrawn from the bot's balance.
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message; only available when copying to private chats
     * @param \Telegram\Parts\SuggestedPostParameters|array|null $suggested_post_parameters Optional. A
     *        JSON-serialized object containing the parameters of the suggested post to send; for direct messages
     *        chats only. If the message is sent as a reply to another suggested post, then that suggested post is
     *        automatically declined.
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. Description of the
     *        message to reply to
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\MessageId>
     *
     * @link https://core.telegram.org/bots/api#copymessage
     */
    public function copyMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $video_start_timestamp = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('copyMessage', get_defined_vars(), ['MessageId']);
    }

    /**
     * Use this method to copy messages of any kind. If some of the specified messages can't be found
     * or copied, they are skipped. Service messages, paid media messages, giveaway messages, giveaway
     * winners messages, and invoice messages can't be copied. A quiz poll can be copied only if the
     * value of the field correct_option_ids is known to the bot. The method is analogous to the method
     * forwardMessages, but the copied messages don't have a link to the original message. Album
     * grouping is kept for copied messages. On success, an Array of MessageId of the sent messages is
     * returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int|string $from_chat_id Unique identifier for the chat where the original messages were sent
     *        (or username of the target bot, supergroup or channel in the format @username)
     * @param list<int> $message_ids A JSON-serialized list of 1-100 identifiers of messages in the chat
     *        from_chat_id to copy. The identifiers must be specified in a strictly increasing order.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the messages will be sent; required if the messages are sent to a direct messages chat
     * @param bool|null $disable_notification Optional. Sends the messages silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent messages from
     *        forwarding and saving
     * @param bool|null $remove_caption Optional. Pass True to copy the messages without their captions
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\MessageId>>
     *
     * @link https://core.telegram.org/bots/api#copymessages
     */
    public function copyMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $remove_caption = null,
    ): PromiseInterface {
        return $this->callApi('copyMessages', get_defined_vars(), ['Array of MessageId']);
    }

    /**
     * Use this method to remove up to 10000 recent reactions in a group or a supergroup chat added by
     * a given user or chat. The bot must have the 'can_delete_messages' administrator right in the
     * chat. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int|null $user_id Optional. Identifier of the user whose reactions will be removed, if the
     *        reactions were added by a user
     * @param int|null $actor_chat_id Optional. Identifier of the chat whose reactions will be removed, if
     *        the reactions were added by a chat
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deleteallmessagereactions
     */
    public function deleteAllMessageReactions(
        int|string $chat_id,
        ?int $user_id = null,
        ?int $actor_chat_id = null,
    ): PromiseInterface {
        return $this->callApi('deleteAllMessageReactions', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete an ephemeral message. Note that it is not guaranteed that the user
     * will receive the message deletion event, especially if they are offline. Returns True on
     * success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $receiver_user_id Identifier of the user who received the message
     * @param int $ephemeral_message_id Identifier of the ephemeral message to delete
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deleteephemeralmessage
     */
    public function deleteEphemeralMessage(
        int|string $chat_id,
        int $receiver_user_id,
        int $ephemeral_message_id,
    ): PromiseInterface {
        return $this->callApi('deleteEphemeralMessage', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:
     * - A message can only be deleted if it was sent less than 48 hours ago.
     * - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
     * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.
     * - Bots can delete incoming messages in private chats.
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * - If the bot is an administrator of a group, it can delete any message there.
     * - If the bot has can_delete_messages administrator right in a supergroup or a channel, it can
     * delete any message there.
     * - If the bot has can_manage_direct_messages administrator right in a channel, it can delete any
     * message in the corresponding direct messages chat.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int $message_id Identifier of the message to delete
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletemessage
     */
    public function deleteMessage(
        int|string $chat_id,
        int $message_id,
    ): PromiseInterface {
        return $this->callApi('deleteMessage', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to remove a reaction from a message in a group or a supergroup chat. The bot
     * must have the 'can_delete_messages' administrator right in the chat. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_id Identifier of the target message
     * @param int|null $user_id Optional. Identifier of the user whose reaction will be removed, if the
     *        reaction was added by a user
     * @param int|null $actor_chat_id Optional. Identifier of the chat whose reaction will be removed, if
     *        the reaction was added by a chat
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletemessagereaction
     */
    public function deleteMessageReaction(
        int|string $chat_id,
        int $message_id,
        ?int $user_id = null,
        ?int $actor_chat_id = null,
    ): PromiseInterface {
        return $this->callApi('deleteMessageReaction', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete multiple messages simultaneously. If some of the specified messages
     * can't be found, they are skipped. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param list<int> $message_ids A JSON-serialized list of 1-100 identifiers of messages to delete. See
     *        deleteMessage for limitations on which messages can be deleted.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletemessages
     */
    public function deleteMessages(
        int|string $chat_id,
        array $message_ids,
    ): PromiseInterface {
        return $this->callApi('deleteMessages', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit the caption of an ephemeral message. Note that it is not guaranteed that
     * the user will receive the message edit event, especially if they are offline. On success, True
     * is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $receiver_user_id Identifier of the user who received the message
     * @param int $ephemeral_message_id Identifier of the ephemeral message to edit
     * @param string|null $caption Optional. New caption of the message, 0-1024 characters after entities
     *        parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media. Supported only for animation, photo and video messages.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editephemeralmessagecaption
     */
    public function editEphemeralMessageCaption(
        int|string $chat_id,
        int $receiver_user_id,
        int $ephemeral_message_id,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editEphemeralMessageCaption', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit the media of an ephemeral message. Note that it is not guaranteed that
     * the user will receive the message edit event, especially if they are offline. On success, True
     * is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $receiver_user_id Identifier of the user who received the message
     * @param int $ephemeral_message_id Identifier of the ephemeral message to edit
     * @param \Telegram\Parts\InputMedia|array $media A JSON-serialized object for the new media content of
     *        the message
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editephemeralmessagemedia
     */
    public function editEphemeralMessageMedia(
        int|string $chat_id,
        int $receiver_user_id,
        int $ephemeral_message_id,
        array|\JsonSerializable $media,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editEphemeralMessageMedia', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit only the reply markup of an ephemeral message. Note that it is not
     * guaranteed that the user will receive the message edit event, especially if they are offline. On
     * success, True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $receiver_user_id Identifier of the user who received the message
     * @param int $ephemeral_message_id Identifier of the ephemeral message to edit
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editephemeralmessagereplymarkup
     */
    public function editEphemeralMessageReplyMarkup(
        int|string $chat_id,
        int $receiver_user_id,
        int $ephemeral_message_id,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editEphemeralMessageReplyMarkup', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit an ephemeral text or rich message. Note that it is not guaranteed that
     * the user will receive the message edit event, especially if they are offline. On success, True
     * is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $receiver_user_id Identifier of the user who received the message
     * @param int $ephemeral_message_id Identifier of the ephemeral message to edit
     * @param string|null $text Optional. New text of the message, 1-4096 characters after entity parsing;
     *        required if rich_message isn't specified
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message text. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $entities Optional. A JSON-serialized list of
     *        special entities that appear in message text, which can be specified instead of parse_mode
     * @param \Telegram\Parts\InputRichMessage|array|null $rich_message Optional. New rich content of the
     *        message; required if text isn't specified
     * @param \Telegram\Parts\LinkPreviewOptions|array|null $link_preview_options Optional. Link preview
     *        generation options for the message
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editephemeralmessagetext
     */
    public function editEphemeralMessageText(
        int|string $chat_id,
        int $receiver_user_id,
        int $ephemeral_message_id,
        ?string $text = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        array|\JsonSerializable|null $rich_message = null,
        array|\JsonSerializable|null $link_preview_options = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editEphemeralMessageText', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit captions of messages. On success, if the edited message is not an inline
     * message, the edited Message is returned, otherwise True is returned. Note that business messages
     * that were not sent by the bot and do not contain an inline keyboard can only be edited within 48
     * hours from the time they were sent.
     *
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message to edit.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param string|null $caption Optional. New caption of the message, 0-1024 characters after entities
     *        parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media. Supported only for animation, photo and video messages.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#editmessagecaption
     */
    public function editMessageCaption(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageCaption', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to edit a checklist on behalf of a connected business account. On success, the
     * edited Message is returned.
     *
     * @param string $business_connection_id Unique identifier of the business connection on behalf of
     *        which the message will be sent
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot in
     *        the format @username
     * @param int $message_id Unique identifier for the target message
     * @param \Telegram\Parts\InputChecklist|array $checklist A JSON-serialized object for the new
     *        checklist
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for the new inline keyboard for the message
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#editmessagechecklist
     */
    public function editMessageChecklist(
        string $business_connection_id,
        int|string $chat_id,
        int $message_id,
        array|\JsonSerializable $checklist,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageChecklist', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its live_period
     * expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if
     * the edited message is not an inline message, the edited Message is returned, otherwise True is
     * returned.
     *
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message to edit.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param int|null $live_period Optional. New period in seconds during which the location can be
     *        updated, starting from the message send date. If 0x7FFFFFFF is specified, then the location can be
     *        updated forever. Otherwise, the new value must not exceed the current live_period by more than a
     *        day, and the live location expiration date must remain within the next 90 days. If not specified,
     *        then live_period remains unchanged.
     * @param float|null $horizontal_accuracy Optional. The radius of uncertainty for the location,
     *        measured in meters; 0-1500
     * @param int|null $heading Optional. Direction in which the user is moving, in degrees. Must be
     *        between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius Optional. The maximum distance for proximity alerts about
     *        approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for a new inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     */
    public function editMessageLiveLocation(
        float $latitude,
        float $longitude,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?int $live_period = null,
        ?float $horizontal_accuracy = null,
        ?int $heading = null,
        ?int $proximity_alert_radius = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageLiveLocation', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to edit animation, audio, document, live photo, photo, or video messages, or to
     * replace a text or a rich message with a media. If a message is part of a message album, then it
     * can be edited only to an audio for audio albums, only to a document for document albums and to a
     * photo, a live photo, or a video otherwise. When an inline message is edited, a new file can't be
     * uploaded; use a previously uploaded file via its file_id or specify a URL. On success, if the
     * edited message is not an inline message, the edited Message is returned, otherwise True is
     * returned. Note that business messages that were not sent by the bot and do not contain an inline
     * keyboard can only be edited within 48 hours from the time they were sent.
     *
     * @param \Telegram\Parts\InputMedia|array $media A JSON-serialized object for the new media content of
     *        the message
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message to edit.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for a new inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#editmessagemedia
     */
    public function editMessageMedia(
        array|\JsonSerializable $media,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageMedia', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if the edited message is
     * not an inline message, the edited Message is returned, otherwise True is returned. Note that
     * business messages that were not sent by the bot and do not contain an inline keyboard can only
     * be edited within 48 hours from the time they were sent.
     *
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message to edit.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     */
    public function editMessageReplyMarkup(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageReplyMarkup', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to edit text, rich and game messages. On success, if the edited message is not
     * an inline message, the edited Message is returned, otherwise True is returned. Note that
     * business messages that were not sent by the bot and do not contain an inline keyboard can only
     * be edited within 48 hours from the time they were sent.
     *
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message to edit.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param string|null $text Optional. New text of the message, 1-4096 characters after entity parsing;
     *        required if rich_message isn't specified
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message text. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $entities Optional. A JSON-serialized list of
     *        special entities that appear in message text, which can be specified instead of parse_mode
     * @param \Telegram\Parts\LinkPreviewOptions|array|null $link_preview_options Optional. Link preview
     *        generation options for the message
     * @param \Telegram\Parts\InputRichMessage|array|null $rich_message Optional. New rich content of the
     *        message; required if text isn't specified. Direct upload of new files and explicit upload of files
     *        by a URL isn't supported when an inline message is edited.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#editmessagetext
     */
    public function editMessageText(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?string $text = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        array|\JsonSerializable|null $link_preview_options = null,
        array|\JsonSerializable|null $rich_message = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('editMessageText', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to forward messages of any kind. Service messages and messages with protected
     * content can't be forwarded. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent
     *        (or username of the target bot, supergroup or channel in the format @username)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be forwarded; required if the message is forwarded to a direct messages chat
     * @param int|null $video_start_timestamp Optional. New start timestamp for the forwarded video in the
     *        message
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the forwarded message from
     *        forwarding and saving
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message; only available when forwarding to private chats
     * @param \Telegram\Parts\SuggestedPostParameters|array|null $suggested_post_parameters Optional. A
     *        JSON-serialized object containing the parameters of the suggested post to send; for direct messages
     *        chats only
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     */
    public function forwardMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $video_start_timestamp = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
    ): PromiseInterface {
        return $this->callApi('forwardMessage', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to forward multiple messages of any kind. If some of the specified messages
     * can't be found or forwarded, they are skipped. Service messages and messages with protected
     * content can't be forwarded. Album grouping is kept for forwarded messages. On success, an Array
     * of MessageId of the sent messages is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int|string $from_chat_id Unique identifier for the chat where the original messages were sent
     *        (or username of the target bot, supergroup or channel in the format @username)
     * @param list<int> $message_ids A JSON-serialized list of 1-100 identifiers of messages in the chat
     *        from_chat_id to forward. The identifiers must be specified in a strictly increasing order.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the messages will be forwarded; required if the messages are forwarded to a direct messages chat
     * @param bool|null $disable_notification Optional. Sends the messages silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the forwarded messages from
     *        forwarding and saving
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\MessageId>>
     *
     * @link https://core.telegram.org/bots/api#forwardmessages
     */
    public function forwardMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
    ): PromiseInterface {
        return $this->callApi('forwardMessages', get_defined_vars(), ['Array of MessageId']);
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat. In private chats and
     * channel direct messages chats, all non-service messages can be pinned. Conversely, the bot must
     * be an administrator with the 'can_pin_messages' right or the 'can_edit_messages' right to pin
     * messages in groups and channels respectively. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $message_id Identifier of a message to pin
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be pinned
     * @param bool|null $disable_notification Optional. Pass True if it is not necessary to send a
     *        notification to all chat members about the new pinned message. Notifications are always disabled in
     *        channels and private chats.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#pinchatmessage
     */
    public function pinChatMessage(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        ?bool $disable_notification = null,
    ): PromiseInterface {
        return $this->callApi('pinChatMessage', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On
     * success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in
     * size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $animation Animation to send. Pass a file_id as String to
     *        send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String
     *        for Telegram to get an animation from the Internet, or upload a new animation using
     *        multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param int|null $duration Optional. Duration of sent animation in seconds
     * @param int|null $width Optional. Animation width
     * @param int|null $height Optional. Animation height
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. Thumbnail of the file sent; can
     *        be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in
     *        JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320.
     *        Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be
     *        only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was
     *        uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param string|null $caption Optional. Animation caption (may also be used when resending animation
     *        by file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the animation caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media
     * @param bool|null $has_spoiler Optional. Pass True if the animation needs to be covered with a
     *        spoiler animation
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendanimation
     */
    public function sendAnimation(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $animation,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendAnimation', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music
     * player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the
     * future.
     * For sending voice messages, use the sendVoice method instead.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $audio Audio file to send. Pass a file_id as String to
     *        send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String
     *        for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data.
     *        More information on Sending Files: https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $caption Optional. Audio caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the audio caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $duration Optional. Duration of the audio in seconds
     * @param string|null $performer Optional. Performer
     * @param string|null $title Optional. Track name
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. Thumbnail of the file sent; can
     *        be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in
     *        JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320.
     *        Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be
     *        only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was
     *        uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     */
    public function sendAudio(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $audio,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendAudio', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients
     * clear its typing status). Returns True on success.
     * We only recommend using this method when a response from the bot will take a noticeable amount
     * of time to arrive.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot or
     *        supergroup in the format @username. Channel chats and channel direct messages chats aren't
     *        supported.
     * @param string $action Type of action to broadcast. Choose one, depending on what the user is about
     *        to receive: typing for text messages, upload_photo for photos, record_video or upload_video for
     *        videos, record_voice or upload_voice for voice notes, upload_document for general files,
     *        choose_sticker for stickers, find_location for location data, record_video_note or upload_video_note
     *        for video notes.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the action will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread or
     *        topic of a forum; for supergroups and private chats of bots with forum topic mode enabled only
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     */
    public function sendChatAction(
        int|string $chat_id,
        string $action,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
    ): PromiseInterface {
        return $this->callApi('sendChatAction', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send a checklist on behalf of a connected business account. On success, the
     * sent Message is returned.
     *
     * @param string $business_connection_id Unique identifier of the business connection on behalf of
     *        which the message will be sent
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot in
     *        the format @username
     * @param \Telegram\Parts\InputChecklist|array $checklist A JSON-serialized object for the checklist to
     *        send
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding and saving
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. A JSON-serialized
     *        object for description of the message to reply to
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for an inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendchecklist
     */
    public function sendChecklist(
        string $business_connection_id,
        int|string $chat_id,
        array|\JsonSerializable $checklist,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendChecklist', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $last_name Optional. Contact's last name
     * @param string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048
     *        bytes
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     */
    public function sendContact(
        int|string $chat_id,
        string $phone_number,
        string $first_name,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $last_name = null,
        ?string $vcard = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendContact', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent
     * Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param string|null $emoji Optional. Emoji on which the dice throw animation is based. Currently,
     *        must be one of "🎲", "🎯", "🏀", "⚽", "🎳", or "🎰". Dice can have values 1-6 for
     *        "🎲", "🎯" and "🎳", values 1-5 for "🏀" and "⚽", and values 1-64 for "🎰". Defaults to
     *        "🎲".
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#senddice
     */
    public function sendDice(
        int|string $chat_id,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $emoji = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendDice', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can
     * currently send files of any type of up to 50 MB in size, this limit may be changed in the
     * future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $document File to send. Pass a file_id as String to send
     *        a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram
     *        to get a file from the Internet, or upload a new one using multipart/form-data. More information on
     *        Sending Files: https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. Thumbnail of the file sent; can
     *        be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in
     *        JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320.
     *        Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be
     *        only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was
     *        uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param string|null $caption Optional. Document caption (may also be used when resending documents by
     *        file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the document caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $disable_content_type_detection Optional. Disables automatic server-side content
     *        type detection for files uploaded using multipart/form-data
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#senddocument
     */
    public function sendDocument(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $document,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $disable_content_type_detection = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendDocument', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send live photos. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        (in the format @channelusername)
     * @param \Telegram\Builders\InputFile|string $live_photo Live photo video to send. The video must be
     *        no longer than 10 seconds and must not exceed 10 MB in size. Pass a file_id as String to send a
     *        video that exists on the Telegram servers (recommended) or upload a new video using
     *        multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently
     *        unsupported.
     * @param \Telegram\Builders\InputFile|string $photo The static photo to send. Pass a file_id as String
     *        to send a photo that exists on the Telegram servers (recommended) or upload a new video using
     *        multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files. Sending live photos by a URL is currently
     *        unsupported.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $caption Optional. Video caption (may also be used when resending videos by
     *        file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the video caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media
     * @param bool|null $has_spoiler Optional. Pass True if the video needs to be covered with a spoiler
     *        animation
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendlivephoto
     */
    public function sendLivePhoto(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $live_photo,
        \Telegram\Builders\InputFile|string $photo,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendLivePhoto', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param float|null $horizontal_accuracy Optional. The radius of uncertainty for the location,
     *        measured in meters; 0-1500
     * @param int|null $live_period Optional. Period in seconds during which the location will be updated
     *        (see Live Locations), must be between 60 and 86400, or 0x7FFFFFFF for live locations that can be
     *        edited indefinitely. Must be 0 for ephemeral messages.
     * @param int|null $heading Optional. For live locations, a direction in which the user is moving, in
     *        degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius Optional. For live locations, a maximum distance for
     *        proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if
     *        specified.
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     */
    public function sendLocation(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?float $horizontal_accuracy = null,
        ?int $live_period = null,
        ?int $heading = null,
        ?int $proximity_alert_radius = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendLocation', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send a group of photos, live photos, videos, documents or audios as an album.
     * Documents and audio files can be only grouped in an album with messages of the same type. On
     * success, an Array of Message objects that were sent is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param
     *        list<\Telegram\Parts\InputMediaAudio|array>|list<\Telegram\Parts\InputMediaDocument|array>|list<\Telegram\Parts\InputMediaLivePhoto|array>|list<\Telegram\Parts\InputMediaPhoto|array>|list<\Telegram\Parts\InputMediaVideo|array>
     *        $media A JSON-serialized Array describing messages to be sent, must include 2-10 items
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the messages will be sent; required if the messages are sent to a direct messages chat
     * @param bool|null $disable_notification Optional. Sends messages silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent messages from
     *        forwarding and saving
     * @param bool|null $allow_paid_broadcast Optional. Pass True to allow up to 1000 messages per second,
     *        ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be
     *        withdrawn from the bot's balance.
     * @param string|null $message_effect_id Optional. Unique identifier of the message effect to be added
     *        to the message; for private chats only
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. Description of the
     *        message to reply to
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\Message>>
     *
     * @link https://core.telegram.org/bots/api#sendmediagroup
     */
    public function sendMediaGroup(
        int|string $chat_id,
        array $media,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $reply_parameters = null,
    ): PromiseInterface {
        return $this->callApi('sendMediaGroup', get_defined_vars(), ['Array of Message']);
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param string $text Text of the message to be sent, 1-4096 characters after entities parsing
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message text. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $entities Optional. A JSON-serialized list of
     *        special entities that appear in message text, which can be specified instead of parse_mode
     * @param \Telegram\Parts\LinkPreviewOptions|array|null $link_preview_options Optional. Link preview
     *        generation options for the message
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     */
    public function sendMessage(
        int|string $chat_id,
        string $text,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        array|\JsonSerializable|null $link_preview_options = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendMessage', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to stream a partial message to a user while the message is being generated. Note
     * that the streamed draft is ephemeral and acts as a temporary 30-second preview - once the output
     * is finalized, you must call sendMessage with the complete message to persist it in the user's
     * chat. Returns True on success.
     *
     * @param int $chat_id Unique identifier for the target private chat
     * @param int $draft_id Unique identifier of the message draft; must be non-zero. Changes to drafts
     *        with the same identifier are animated. Otherwise, the draft is replaced without animation.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread
     * @param string|null $text Optional. Text of the message to be sent, 0-4096 characters after entities
     *        parsing. Pass an empty text to show a "Thinking..." placeholder.
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message text. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $entities Optional. A JSON-serialized list of
     *        special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $can_stop Optional. Pass True to show the user a button to stop further drafts. The
     *        bot will receive an Update "stopped_message_generation" if the user presses the button.
     * @param bool|null $keep_on_stop Optional. Pass True to keep the draft in the chat when the button is
     *        pressed. The draft will still disappear after a short time or if the bot sends a message. To fully
     *        preserve the partial draft, the bot should send it as a new message.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#sendmessagedraft
     */
    public function sendMessageDraft(
        int $chat_id,
        int $draft_id,
        ?int $message_thread_id = null,
        ?string $text = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        ?bool $can_stop = null,
        ?bool $keep_on_stop = null,
    ): PromiseInterface {
        return $this->callApi('sendMessageDraft', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send paid media. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username. If the chat is a channel, all Telegram Star proceeds
     *        from this media will be credited to the chat's balance. Otherwise, they will be credited to the
     *        bot's balance.
     * @param int $star_count The number of Telegram Stars that must be paid to buy access to the media;
     *        1-25000
     * @param list<\Telegram\Parts\InputPaidMedia|array> $media A JSON-serialized Array describing the
     *        media to be sent; up to 10 items
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param string|null $payload Optional. Bot-defined paid media payload, 0-128 bytes. This will not be
     *        displayed to the user, use it for your internal processes.
     * @param string|null $caption Optional. Media caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the media caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media
     * @param bool|null $disable_notification Optional. Sends the message silently. Users will receive a
     *        notification with no sound.
     * @param bool|null $protect_content Optional. Protects the contents of the sent message from
     *        forwarding and saving
     * @param bool|null $allow_paid_broadcast Optional. Pass True to allow up to 1000 messages per second,
     *        ignoring broadcasting limits for a fee of 0.1 Telegram Stars per message. The relevant Stars will be
     *        withdrawn from the bot's balance.
     * @param \Telegram\Parts\SuggestedPostParameters|array|null $suggested_post_parameters Optional. A
     *        JSON-serialized object containing the parameters of the suggested post to send; for direct messages
     *        chats only. If the message is sent as a reply to another suggested post, then that suggested post is
     *        automatically declined.
     * @param \Telegram\Parts\ReplyParameters|array|null $reply_parameters Optional. Description of the
     *        message to reply to
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendpaidmedia
     */
    public function sendPaidMedia(
        int|string $chat_id,
        int $star_count,
        array $media,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $payload = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendPaidMedia', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $photo Photo to send. Pass a file_id as String to send a
     *        photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram
     *        to get a photo from the Internet, or upload a new photo using multipart/form-data. The photo must be
     *        at most 10 MB in size. The photo's width and height must not exceed 10000 in total. Width and height
     *        ratio must be at most 20. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $caption Optional. Photo caption (may also be used when resending photos by
     *        file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the photo caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media
     * @param bool|null $has_spoiler Optional. Pass True if the photo needs to be covered with a spoiler
     *        animation
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     */
    public function sendPhoto(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $photo,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendPhoto', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send a native poll. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username. Polls can't be sent to channel direct messages chats.
     * @param string $question Poll question, 1-300 characters
     * @param list<\Telegram\Parts\InputPollOption|array> $options A JSON-serialized list of 1-12 answer
     *        options
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param string|null $question_parse_mode Optional. Mode for parsing entities in the question. See
     *        formatting options for more details. Currently, only custom emoji entities are allowed.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $question_entities Optional. A JSON-serialized
     *        list of special entities that appear in the poll question. It can be specified instead of
     *        question_parse_mode.
     * @param bool|null $is_anonymous Optional. True, if the poll needs to be anonymous, defaults to True
     * @param string|null $type Optional. Poll type, "quiz" or "regular", defaults to "regular"
     * @param bool|null $allows_multiple_answers Optional. Pass True if the poll allows multiple answers,
     *        defaults to False
     * @param bool|null $allows_revoting Optional. Pass True if the poll allows to change chosen answer
     *        options, defaults to False for quizzes and to True for regular polls
     * @param bool|null $shuffle_options Optional. Pass True if the poll options must be shown in random
     *        order
     * @param bool|null $allow_adding_options Optional. Pass True if answer options can be added to the
     *        poll after creation; not supported for anonymous polls and quizzes
     * @param bool|null $hide_results_until_closes Optional. Pass True if poll results must be shown only
     *        after the poll closes
     * @param bool|null $members_only Optional. Pass True if voting is limited to users who have been
     *        members of the chat where the poll is being sent for more than 24 hours; for channel chats only
     * @param list<string>|null $country_codes Optional. A JSON-serialized list of 0-12 two-letter ISO
     *        3166-1 alpha-2 country codes indicating the countries from which users can vote in the poll; for
     *        channel chats only. Use "FT" as a country code to allow users with anonymous numbers to vote. If
     *        omitted or empty, then users from any country can participate in the poll.
     * @param list<int>|null $correct_option_ids Optional. A JSON-serialized list of monotonically
     *        increasing 0-based identifiers of the correct answer options, required for polls in quiz mode
     * @param string|null $explanation Optional. Text that is shown when a user chooses an incorrect answer
     *        or taps on the lamp icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after
     *        entities parsing
     * @param string|null $explanation_parse_mode Optional. Mode for parsing entities in the explanation.
     *        See formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $explanation_entities Optional. A
     *        JSON-serialized list of special entities that appear in the poll explanation. It can be specified
     *        instead of explanation_parse_mode.
     * @param \Telegram\Parts\InputPollMedia|array|null $explanation_media Optional. Media added to the
     *        quiz explanation
     * @param int|null $open_period Optional. Amount of time in seconds the poll will be active after
     *        creation, 5-2628000. Can't be used together with close_date.
     * @param int|null $close_date Optional. Point in time (Unix timestamp) when the poll will be
     *        automatically closed. Must be at least 5 and no more than 2628000 seconds in the future. Can't be
     *        used together with open_period.
     * @param bool|null $is_closed Optional. Pass True if the poll needs to be immediately closed. This can
     *        be useful for poll preview.
     * @param string|null $description Optional. Description of the poll to be sent, 0-1024 characters
     *        after entities parsing
     * @param string|null $description_parse_mode Optional. Mode for parsing entities in the poll
     *        description. See formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $description_entities Optional. A
     *        JSON-serialized list of special entities that appear in the poll description, which can be specified
     *        instead of description_parse_mode
     * @param \Telegram\Parts\InputPollMedia|array|null $media Optional. Media added to the poll
     *        description
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendpoll
     */
    public function sendPoll(
        int|string $chat_id,
        string $question,
        array $options,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?string $question_parse_mode = null,
        ?array $question_entities = null,
        ?bool $is_anonymous = null,
        ?string $type = null,
        ?bool $allows_multiple_answers = null,
        ?bool $allows_revoting = null,
        ?bool $shuffle_options = null,
        ?bool $allow_adding_options = null,
        ?bool $hide_results_until_closes = null,
        ?bool $members_only = null,
        ?array $country_codes = null,
        ?array $correct_option_ids = null,
        ?string $explanation = null,
        ?string $explanation_parse_mode = null,
        ?array $explanation_entities = null,
        array|\JsonSerializable|null $explanation_media = null,
        ?int $open_period = null,
        ?int $close_date = null,
        ?bool $is_closed = null,
        ?string $description = null,
        ?string $description_parse_mode = null,
        ?array $description_entities = null,
        array|\JsonSerializable|null $media = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendPoll', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send rich messages. If the message contains a block with a media element,
     * then the bot must have the right to send the media to the chat. On success, the sent Message is
     * returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Parts\InputRichMessage|array $rich_message The message to be sent
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent. Bot can send rich messages on behalf of a business account
     *        only if the corresponding user can send rich messages.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendrichmessage
     */
    public function sendRichMessage(
        int|string $chat_id,
        array|\JsonSerializable $rich_message,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendRichMessage', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to stream a partial rich message to a user while the message is being generated.
     * Note that the streamed draft is ephemeral and acts as a temporary 30-second preview - once the
     * output is finalized, you must call sendRichMessage with the complete message to persist it in
     * the user's chat. Returns True on success.
     *
     * @param int $chat_id Unique identifier for the target private chat
     * @param int $draft_id Unique identifier of the message draft; must be non-zero. Changes to drafts
     *        with the same identifier are animated. Otherwise, the draft is replaced without animation.
     * @param \Telegram\Parts\InputRichMessage|array $rich_message The partial message to be streamed.
     *        Direct upload of new files and explicit upload of files by a URL isn't supported.
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread
     * @param bool|null $can_stop Optional. Pass True to show the user a button to stop further drafts. The
     *        bot will receive an Update "stopped_message_generation" if the user presses the button.
     * @param bool|null $keep_on_stop Optional. Pass True to keep the draft in the chat when the button is
     *        pressed. The draft will still disappear after a short time or if the bot sends a message. To fully
     *        preserve the partial draft, the bot should send it as a new message.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#sendrichmessagedraft
     */
    public function sendRichMessageDraft(
        int $chat_id,
        int $draft_id,
        array|\JsonSerializable $rich_message,
        ?int $message_thread_id = null,
        ?bool $can_stop = null,
        ?bool $keep_on_stop = null,
    ): PromiseInterface {
        return $this->callApi('sendRichMessageDraft', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $foursquare_id Optional. Foursquare identifier of the venue
     * @param string|null $foursquare_type Optional. Foursquare type of the venue, if known. (For example,
     *        "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
     * @param string|null $google_place_id Optional. Google Places identifier of the venue
     * @param string|null $google_place_type Optional. Google Places type of the venue. (See supported
     *        types.)
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     */
    public function sendVenue(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $foursquare_id = null,
        ?string $foursquare_type = null,
        ?string $google_place_id = null,
        ?string $google_place_type = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendVenue', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be
     * sent as Document). On success, the sent Message is returned. Bots can currently send video files
     * of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $video Video to send. Pass a file_id as String to send a
     *        video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram
     *        to get a video from the Internet, or upload a new video using multipart/form-data. More information
     *        on Sending Files: https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param int|null $duration Optional. Duration of sent video in seconds
     * @param int|null $width Optional. Video width
     * @param int|null $height Optional. Video height
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. Thumbnail of the file sent; can
     *        be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in
     *        JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320.
     *        Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be
     *        only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was
     *        uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param \Telegram\Builders\InputFile|string|null $cover Optional. Cover for the video in the message.
     *        Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL
     *        for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new
     *        one using multipart/form-data under <file_attach_name> name. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
     * @param int|null $start_timestamp Optional. Start timestamp for the video in the message
     * @param string|null $caption Optional. Video caption (may also be used when resending videos by
     *        file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the video caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above
     *        the message media
     * @param bool|null $has_spoiler Optional. Pass True if the video needs to be covered with a spoiler
     *        animation
     * @param bool|null $supports_streaming Optional. Pass True if the uploaded video is suitable for
     *        streaming
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     */
    public function sendVideo(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $video,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
        \Telegram\Builders\InputFile|string|null $cover = null,
        ?int $start_timestamp = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $supports_streaming = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendVideo', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send a rounded square MPEG4 video of up to 1 minute long. On success, the
     * sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $video_note Video note to send. Pass a file_id as String
     *        to send a video note that exists on the Telegram servers (recommended) or upload a new video using
     *        multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files. Sending video notes by a URL is currently
     *        unsupported.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param int|null $duration Optional. Duration of sent video in seconds
     * @param int|null $length Optional. Video width and height, i.e. diameter of the video message
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. Thumbnail of the file sent; can
     *        be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in
     *        JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320.
     *        Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be
     *        only uploaded as a new file, so you can pass "attach://<file_attach_name>" if the thumbnail was
     *        uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendvideonote
     */
    public function sendVideoNote(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $video_note,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?int $duration = null,
        ?int $length = null,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendVideoNote', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a
     * playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS,
     * or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document). On
     * success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in
     * size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $voice Audio file to send. Pass a file_id as String to
     *        send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for
     *        Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More
     *        information on Sending Files: https://core.telegram.org/bots/api#sending-files
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $caption Optional. Voice message caption, 0-1024 characters after entities
     *        parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the voice message caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $duration Optional. Duration of the voice message in seconds
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
     * @param
     *        \Telegram\Parts\InlineKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardMarkup|array|\Telegram\Parts\ReplyKeyboardRemove|array|\Telegram\Parts\ForceReply|array|null
     *        $reply_markup Optional. Additional interface options. A JSON-serialized object for an inline
     *        keyboard, custom reply keyboard, instructions to remove a reply keyboard or to force a reply from
     *        the user.
     *
     * @return PromiseInterface<\Telegram\Parts\Message>
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     */
    public function sendVoice(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $voice,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?int $duration = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendVoice', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to change the chosen reactions on a message. Service messages of some types
     * can't be reacted to. Automatically forwarded messages from a channel to its discussion group
     * have the same available reactions as messages in the channel. Bots can't use paid reactions.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int $message_id Identifier of the target message. If the message belongs to a media group,
     *        the reaction is set to the first non-deleted message in the group instead.
     * @param list<\Telegram\Parts\ReactionType|array>|null $reaction Optional. A JSON-serialized list of
     *        reaction types to set on the message. Currently, as non-premium users, bots can set up to one
     *        reaction per message. A custom emoji reaction can be used if it is either already present on the
     *        message or explicitly allowed by chat administrators. Paid reactions can't be used by bots.
     * @param bool|null $is_big Optional. Pass True to set the reaction with a big animation
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmessagereaction
     */
    public function setMessageReaction(
        int|string $chat_id,
        int $message_id,
        ?array $reaction = null,
        ?bool $is_big = null,
    ): PromiseInterface {
        return $this->callApi('setMessageReaction', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires. On success,
     * if the message is not an inline message, the edited Message is returned, otherwise True is
     * returned.
     *
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param int|string|null $chat_id Optional. Required if inline_message_id is not specified. Unique
     *        identifier for the target chat or username of the target bot, supergroup or channel in the format
     *        @username.
     * @param int|null $message_id Optional. Required if inline_message_id is not specified. Identifier of
     *        the message with live location to stop.
     * @param string|null $inline_message_id Optional. Required if chat_id and message_id are not
     *        specified. Identifier of the inline message.
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for a new inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Message|bool>
     *
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     */
    public function stopMessageLiveLocation(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('stopMessageLiveLocation', get_defined_vars(), ['Message', 'Boolean']);
    }

    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped Poll is
     * returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param int $message_id Identifier of the original message with the poll
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message to be edited was sent
     * @param \Telegram\Parts\InlineKeyboardMarkup|array|null $reply_markup Optional. A JSON-serialized
     *        object for a new message inline keyboard
     *
     * @return PromiseInterface<\Telegram\Parts\Poll>
     *
     * @link https://core.telegram.org/bots/api#stoppoll
     */
    public function stopPoll(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('stopPoll', get_defined_vars(), ['Poll']);
    }

    /**
     * Use this method to clear the list of pinned messages in a chat. In private chats and channel
     * direct messages chats, no additional rights are required to unpin all pinned messages.
     * Conversely, the bot must be an administrator with the 'can_pin_messages' right or the
     * 'can_edit_messages' right to unpin all pinned messages in groups and channels respectively.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unpinallchatmessages
     */
    public function unpinAllChatMessages(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('unpinAllChatMessages', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat. In private chats
     * and channel direct messages chats, all messages can be unpinned. Conversely, the bot must be an
     * administrator with the 'can_pin_messages' right or the 'can_edit_messages' right to unpin
     * messages in groups and channels respectively. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be unpinned
     * @param int|null $message_id Optional. Identifier of the message to unpin. Required if
     *        business_connection_id is specified. If not specified, the most recent pinned message (by sending
     *        date) will be unpinned.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     */
    public function unpinChatMessage(
        int|string $chat_id,
        ?string $business_connection_id = null,
        ?int $message_id = null,
    ): PromiseInterface {
        return $this->callApi('unpinChatMessage', get_defined_vars(), ['Boolean']);
    }
}
