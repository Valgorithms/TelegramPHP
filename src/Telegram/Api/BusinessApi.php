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
 * Telegram Business accounts a bot manages on a user's behalf, and the stories it posts for them.
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
trait BusinessApi
{
    /**
     * Delete messages on behalf of a business account. Requires the can_delete_sent_messages business
     * bot right to delete messages sent by the bot itself, or the can_delete_all_messages business bot
     * right to delete any message. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection on behalf of
     *        which to delete the messages
     * @param list<int> $message_ids A JSON-serialized list of 1-100 identifiers of messages to delete. All
     *        messages must be from the same chat. See deleteMessage for limitations on which messages can be
     *        deleted.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletebusinessmessages
     */
    public function deleteBusinessMessages(
        string $business_connection_id,
        array $message_ids,
    ): PromiseInterface {
        return $this->callApi('deleteBusinessMessages', get_defined_vars(), ['Boolean']);
    }

    /**
     * Deletes a story previously posted by the bot on behalf of a managed business account. Requires
     * the can_manage_stories business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $story_id Unique identifier of the story to delete
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletestory
     */
    public function deleteStory(
        string $business_connection_id,
        int $story_id,
    ): PromiseInterface {
        return $this->callApi('deleteStory', get_defined_vars(), ['Boolean']);
    }

    /**
     * Edits a story previously posted by the bot on behalf of a managed business account. Requires the
     * can_manage_stories business bot right. Returns Story on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $story_id Unique identifier of the story to edit
     * @param \Telegram\Parts\InputStoryContent|array $content Content of the story
     * @param string|null $caption Optional. Caption of the story, 0-2048 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the story caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param list<\Telegram\Parts\StoryArea|array>|null $areas Optional. A JSON-serialized list of
     *        clickable areas to be shown on the story
     *
     * @return PromiseInterface<\Telegram\Parts\Story>
     *
     * @link https://core.telegram.org/bots/api#editstory
     */
    public function editStory(
        string $business_connection_id,
        int $story_id,
        array|\JsonSerializable $content,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?array $areas = null,
    ): PromiseInterface {
        return $this->callApi('editStory', get_defined_vars(), ['Story']);
    }

    /**
     * Returns the amount of Telegram Stars owned by a managed business account. Requires the
     * can_view_gifts_and_stars business bot right. Returns StarAmount on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     *
     * @return PromiseInterface<\Telegram\Parts\StarAmount>
     *
     * @link https://core.telegram.org/bots/api#getbusinessaccountstarbalance
     */
    public function getBusinessAccountStarBalance(
        string $business_connection_id,
    ): PromiseInterface {
        return $this->callApi('getBusinessAccountStarBalance', get_defined_vars(), ['StarAmount']);
    }

    /**
     * Use this method to get information about the connection of the bot with a business account.
     * Returns a BusinessConnection object on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     *
     * @return PromiseInterface<\Telegram\Parts\BusinessConnection>
     *
     * @link https://core.telegram.org/bots/api#getbusinessconnection
     */
    public function getBusinessConnection(
        string $business_connection_id,
    ): PromiseInterface {
        return $this->callApi('getBusinessConnection', get_defined_vars(), ['BusinessConnection']);
    }

    /**
     * Posts a story on behalf of a managed business account. Requires the can_manage_stories business
     * bot right. Returns Story on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param \Telegram\Parts\InputStoryContent|array $content Content of the story
     * @param int $active_period Period after which the story is moved to the archive, in seconds; must be
     *        one of 6 * 3600, 12 * 3600, 86400, or 2 * 86400
     * @param string|null $caption Optional. Caption of the story, 0-2048 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the story caption. See
     *        formatting options for more details.
     * @param list<\Telegram\Parts\MessageEntity|array>|null $caption_entities Optional. A JSON-serialized
     *        list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param list<\Telegram\Parts\StoryArea|array>|null $areas Optional. A JSON-serialized list of
     *        clickable areas to be shown on the story
     * @param bool|null $post_to_chat_page Optional. Pass True to keep the story accessible after it
     *        expires
     * @param bool|null $protect_content Optional. Pass True if the content of the story must be protected
     *        from forwarding and screenshotting
     *
     * @return PromiseInterface<\Telegram\Parts\Story>
     *
     * @link https://core.telegram.org/bots/api#poststory
     */
    public function postStory(
        string $business_connection_id,
        array|\JsonSerializable $content,
        int $active_period,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?array $areas = null,
        ?bool $post_to_chat_page = null,
        ?bool $protect_content = null,
    ): PromiseInterface {
        return $this->callApi('postStory', get_defined_vars(), ['Story']);
    }

    /**
     * Marks incoming message as read on behalf of a business account. Requires the can_read_messages
     * business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection on behalf of
     *        which to read the message
     * @param int $chat_id Unique identifier of the chat in which the message was received. The chat must
     *        have been active in the last 24 hours.
     * @param int $message_id Unique identifier of the message to mark as read
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#readbusinessmessage
     */
    public function readBusinessMessage(
        string $business_connection_id,
        int $chat_id,
        int $message_id,
    ): PromiseInterface {
        return $this->callApi('readBusinessMessage', get_defined_vars(), ['Boolean']);
    }

    /**
     * Removes the current profile photo of a managed business account. Requires the
     * can_edit_profile_photo business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool|null $is_public Optional. Pass True to remove the public photo, which is visible even if
     *        the main photo is hidden by the business account's privacy settings. After the main photo is
     *        removed, the previous profile photo (if present) becomes the main photo.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#removebusinessaccountprofilephoto
     */
    public function removeBusinessAccountProfilePhoto(
        string $business_connection_id,
        ?bool $is_public = null,
    ): PromiseInterface {
        return $this->callApi('removeBusinessAccountProfilePhoto', get_defined_vars(), ['Boolean']);
    }

    /**
     * Reposts a story on behalf of a business account from another business account. Both business
     * accounts must be managed by the same bot, and the story on the source account must have been
     * posted (or reposted) by the bot. Requires the can_manage_stories business bot right for both
     * business accounts. Returns Story on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $from_chat_id Unique identifier of the chat which posted the story that should be
     *        reposted
     * @param int $from_story_id Unique identifier of the story that should be reposted
     * @param int $active_period Period after which the story is moved to the archive, in seconds; must be
     *        one of 6 * 3600, 12 * 3600, 86400, or 2 * 86400
     * @param bool|null $post_to_chat_page Optional. Pass True to keep the story accessible after it
     *        expires
     * @param bool|null $protect_content Optional. Pass True if the content of the story must be protected
     *        from forwarding and screenshotting
     *
     * @return PromiseInterface<\Telegram\Parts\Story>
     *
     * @link https://core.telegram.org/bots/api#repoststory
     */
    public function repostStory(
        string $business_connection_id,
        int $from_chat_id,
        int $from_story_id,
        int $active_period,
        ?bool $post_to_chat_page = null,
        ?bool $protect_content = null,
    ): PromiseInterface {
        return $this->callApi('repostStory', get_defined_vars(), ['Story']);
    }

    /**
     * Changes the bio of a managed business account. Requires the can_change_bio business bot right.
     * Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string|null $bio Optional. The new value of the bio for the business account; 0-140
     *        characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setbusinessaccountbio
     */
    public function setBusinessAccountBio(
        string $business_connection_id,
        ?string $bio = null,
    ): PromiseInterface {
        return $this->callApi('setBusinessAccountBio', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the first and last name of a managed business account. Requires the can_change_name
     * business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $first_name The new value of the first name for the business account; 1-64 characters
     * @param string|null $last_name Optional. The new value of the last name for the business account;
     *        0-64 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setbusinessaccountname
     */
    public function setBusinessAccountName(
        string $business_connection_id,
        string $first_name,
        ?string $last_name = null,
    ): PromiseInterface {
        return $this->callApi('setBusinessAccountName', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the profile photo of a managed business account. Requires the can_edit_profile_photo
     * business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param \Telegram\Parts\InputProfilePhoto|array $photo The new profile photo to set
     * @param bool|null $is_public Optional. Pass True to set the public photo, which will be visible even
     *        if the main photo is hidden by the business account's privacy settings. An account can have only one
     *        public photo.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setbusinessaccountprofilephoto
     */
    public function setBusinessAccountProfilePhoto(
        string $business_connection_id,
        array|\JsonSerializable $photo,
        ?bool $is_public = null,
    ): PromiseInterface {
        return $this->callApi('setBusinessAccountProfilePhoto', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the username of a managed business account. Requires the can_change_username business
     * bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string|null $username Optional. The new value of the username for the business account; 0-32
     *        characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setbusinessaccountusername
     */
    public function setBusinessAccountUsername(
        string $business_connection_id,
        ?string $username = null,
    ): PromiseInterface {
        return $this->callApi('setBusinessAccountUsername', get_defined_vars(), ['Boolean']);
    }

    /**
     * Transfers Telegram Stars from the business account balance to the bot's balance. Requires the
     * can_transfer_stars business bot right. Returns True on success.
     *
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $star_count Number of Telegram Stars to transfer; 1-10000
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#transferbusinessaccountstars
     */
    public function transferBusinessAccountStars(
        string $business_connection_id,
        int $star_count,
    ): PromiseInterface {
        return $this->callApi('transferBusinessAccountStars', get_defined_vars(), ['Boolean']);
    }
}
