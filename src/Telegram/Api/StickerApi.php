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
 * Sticker sets: creating them, editing their contents, and their thumbnails.
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
trait StickerApi
{
    /**
     * Use this method to add a new sticker to a set created by the bot. Emoji sticker sets can have up
     * to 200 stickers. Other sticker sets can have up to 120 stickers. Returns True on success.
     *
     * @param int $user_id User identifier of sticker set owner
     * @param string $name Sticker set name
     * @param \Telegram\Parts\InputSticker|array $sticker A JSON-serialized object with information about
     *        the added sticker. If exactly the same sticker had already been added to the set, then the set isn't
     *        changed.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#addstickertoset
     */
    public function addStickerToSet(
        int $user_id,
        string $name,
        array|\JsonSerializable $sticker,
    ): PromiseInterface {
        return $this->callApi('addStickerToSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the
     * sticker set thus created. Returns True on success.
     *
     * @param int $user_id User identifier of created sticker set owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals).
     *        Can contain only English letters, digits and underscores. Must begin with a letter, can't contain
     *        consecutive underscores and must end in "_by_<bot_username>". <bot_username> is case insensitive.
     *        1-64 characters.
     * @param string $title Sticker set title, 1-64 characters
     * @param list<\Telegram\Parts\InputSticker|array> $stickers A JSON-serialized list of 1-50 initial
     *        stickers to be added to the sticker set
     * @param string|null $sticker_type Optional. Type of stickers in the set, pass "regular", "mask", or
     *        "custom_emoji". By default, a regular sticker set is created.
     * @param bool|null $needs_repainting Optional. Pass True if stickers in the sticker set must be
     *        repainted to the color of text when used in messages, the accent color if used as emoji status,
     *        white on chat photos, or another appropriate color based on context; for custom emoji sticker sets
     *        only
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#createnewstickerset
     */
    public function createNewStickerSet(
        int $user_id,
        string $name,
        string $title,
        array $stickers,
        ?string $sticker_type = null,
        ?bool $needs_repainting = null,
    ): PromiseInterface {
        return $this->callApi('createNewStickerSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot
     * can use this method. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     */
    public function deleteChatStickerSet(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('deleteChatStickerSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     */
    public function deleteStickerFromSet(
        string $sticker,
    ): PromiseInterface {
        return $this->callApi('deleteStickerFromSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a sticker set that was created by the bot. Returns True on success.
     *
     * @param string $name Sticker set name
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletestickerset
     */
    public function deleteStickerSet(
        string $name,
    ): PromiseInterface {
        return $this->callApi('deleteStickerSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to get information about custom emoji stickers by their identifiers. Returns an
     * Array of Sticker objects.
     *
     * @param list<string> $custom_emoji_ids A JSON-serialized list of custom emoji identifiers. At most
     *        200 custom emoji identifiers can be specified.
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\Sticker>>
     *
     * @link https://core.telegram.org/bots/api#getcustomemojistickers
     */
    public function getCustomEmojiStickers(
        array $custom_emoji_ids,
    ): PromiseInterface {
        return $this->callApi('getCustomEmojiStickers', get_defined_vars(), ['Array of Sticker']);
    }

    /**
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any
     * user. Requires no parameters. Returns an Array of Sticker objects.
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\Sticker>>
     *
     * @link https://core.telegram.org/bots/api#getforumtopiciconstickers
     */
    public function getForumTopicIconStickers(): PromiseInterface
    {
        return $this->callApi('getForumTopicIconStickers', [], ['Array of Sticker']);
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     *
     * @param string $name Name of the sticker set
     *
     * @return PromiseInterface<\Telegram\Parts\StickerSet>
     *
     * @link https://core.telegram.org/bots/api#getstickerset
     */
    public function getStickerSet(
        string $name,
    ): PromiseInterface {
        return $this->callApi('getStickerSet', get_defined_vars(), ['StickerSet']);
    }

    /**
     * Use this method to replace an existing sticker in a sticker set with a new one. The method is
     * equivalent to calling deleteStickerFromSet, then addStickerToSet, then setStickerPositionInSet.
     * Returns True on success.
     *
     * @param int $user_id User identifier of the sticker set owner
     * @param string $name Sticker set name
     * @param string $old_sticker File identifier of the replaced sticker
     * @param \Telegram\Parts\InputSticker|array $sticker A JSON-serialized object with information about
     *        the added sticker. If exactly the same sticker had already been added to the set, then the set
     *        remains unchanged.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#replacestickerinset
     */
    public function replaceStickerInSet(
        int $user_id,
        string $name,
        string $old_sticker,
        array|\JsonSerializable $sticker,
    ): PromiseInterface {
        return $this->callApi('replaceStickerInSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers. On success, the
     * sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username
     * @param \Telegram\Builders\InputFile|string $sticker Sticker to send. Pass a file_id as String to
     *        send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for
     *        Telegram to get a .WEBP sticker from the Internet, or upload a new .WEBP, .TGS, or .WEBM sticker
     *        using multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files. Video and animated stickers can't be sent via an
     *        HTTP URL.
     * @param string|null $business_connection_id Optional. Unique identifier of the business connection on
     *        behalf of which the message will be sent
     * @param int|null $message_thread_id Optional. Unique identifier for the target message thread (topic)
     *        of a forum; for forum supergroups and private chats of bots with forum topic mode enabled only
     * @param int|null $direct_messages_topic_id Optional. Identifier of the direct messages topic to which
     *        the message will be sent; required if the message is sent to a direct messages chat
     * @param \Telegram\Parts\EphemeralMessageParameters|array|null $ephemeral_message_parameters Optional.
     *        A JSON-serialized object containing the parameters of the ephemeral message to send
     * @param string|null $emoji Optional. Emoji associated with the sticker; only for just uploaded
     *        stickers
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
     * @link https://core.telegram.org/bots/api#sendsticker
     */
    public function sendSticker(
        int|string $chat_id,
        \Telegram\Builders\InputFile|string $sticker,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        array|\JsonSerializable|null $ephemeral_message_parameters = null,
        ?string $emoji = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        array|\JsonSerializable|null $suggested_post_parameters = null,
        array|\JsonSerializable|null $reply_parameters = null,
        array|\JsonSerializable|null $reply_markup = null,
    ): PromiseInterface {
        return $this->callApi('sendSticker', get_defined_vars(), ['Message']);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot
     * can use this method. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param string $sticker_set_name Name of the sticker set to be set as the group sticker set
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatstickerset
     */
    public function setChatStickerSet(
        int|string $chat_id,
        string $sticker_set_name,
    ): PromiseInterface {
        return $this->callApi('setChatStickerSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set the thumbnail of a custom emoji sticker set. Returns True on success.
     *
     * @param string $name Sticker set name
     * @param string|null $custom_emoji_id Optional. Custom emoji identifier of a sticker from the sticker
     *        set; pass an empty string to drop the thumbnail and use the first sticker as the thumbnail
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
     */
    public function setCustomEmojiStickerSetThumbnail(
        string $name,
        ?string $custom_emoji_id = null,
    ): PromiseInterface {
        return $this->callApi('setCustomEmojiStickerSetThumbnail', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker. The
     * sticker must belong to a sticker set created by the bot. Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @param list<string> $emoji_list A JSON-serialized list of 1-20 emoji associated with the sticker
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickeremojilist
     */
    public function setStickerEmojiList(
        string $sticker,
        array $emoji_list,
    ): PromiseInterface {
        return $this->callApi('setStickerEmojiList', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker. The
     * sticker must belong to a sticker set created by the bot. Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @param list<string>|null $keywords Optional. A JSON-serialized list of 0-20 search keywords for the
     *        sticker with total length of up to 64 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickerkeywords
     */
    public function setStickerKeywords(
        string $sticker,
        ?array $keywords = null,
    ): PromiseInterface {
        return $this->callApi('setStickerKeywords', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the mask position of a mask sticker. The sticker must belong to a
     * sticker set that was created by the bot. Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @param \Telegram\Parts\MaskPosition|array|null $mask_position Optional. A JSON-serialized object
     *        with the position where the mask should be placed on faces. Omit the parameter to remove the mask
     *        position.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickermaskposition
     */
    public function setStickerMaskPosition(
        string $sticker,
        array|\JsonSerializable|null $mask_position = null,
    ): PromiseInterface {
        return $this->callApi('setStickerMaskPosition', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns
     * True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     */
    public function setStickerPositionInSet(
        string $sticker,
        int $position,
    ): PromiseInterface {
        return $this->callApi('setStickerPositionInSet', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set the thumbnail of a regular or mask sticker set. The format of the
     * thumbnail file must match the format of the stickers in the set. Returns True on success.
     *
     * @param string $name Sticker set name
     * @param int $user_id User identifier of the sticker set owner
     * @param string $format Format of the thumbnail, must be one of "static" for a .WEBP or .PNG image,
     *        "animated" for a .TGS animation, or "video" for a .WEBM video
     * @param \Telegram\Builders\InputFile|string|null $thumbnail Optional. A .WEBP or .PNG image with the
     *        thumbnail, must be up to 128 kilobytes in size and have a width and height of exactly 100px, or a
     *        .TGS animation with a thumbnail up to 32 kilobytes in size (see
     *        https://core.telegram.org/stickers#animation-requirements for animated sticker technical
     *        requirements), or a .WEBM video with the thumbnail up to 32 kilobytes in size; see
     *        https://core.telegram.org/stickers#video-requirements for video sticker technical requirements. Pass
     *        a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL
     *        as a String for Telegram to get a file from the Internet, or upload a new one using
     *        multipart/form-data. More information on Sending Files:
     *        https://core.telegram.org/bots/api#sending-files. Animated and video sticker set thumbnails can't be
     *        uploaded via HTTP URL. If omitted, then the thumbnail is dropped and the first sticker is used as
     *        the thumbnail.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickersetthumbnail
     */
    public function setStickerSetThumbnail(
        string $name,
        int $user_id,
        string $format,
        \Telegram\Builders\InputFile|string|null $thumbnail = null,
    ): PromiseInterface {
        return $this->callApi('setStickerSetThumbnail', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set the title of a created sticker set. Returns True on success.
     *
     * @param string $name Sticker set name
     * @param string $title Sticker set title, 1-64 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setstickersettitle
     */
    public function setStickerSetTitle(
        string $name,
        string $title,
    ): PromiseInterface {
        return $this->callApi('setStickerSetTitle', get_defined_vars(), ['Boolean']);
    }
}
