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
 * Chats and the people in them: membership, administrators, permissions, invite links, forum
 * topics, join requests, and chat appearance.
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
trait ChatApi
{
    /**
     * Use this method to process a received chat join request query. Returns True on success.
     *
     * @param string $chat_join_request_query_id Unique identifier of the join request query
     * @param string $result Result of the query. Must be either "approve" to allow the user to join the
     *        chat, "decline" to disallow the user to join the chat, or "queue" to leave the decision to other
     *        administrators.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#answerchatjoinrequestquery
     */
    public function answerChatJoinRequestQuery(
        string $chat_join_request_query_id,
        string $result,
    ): PromiseInterface {
        return $this->callApi('answerChatJoinRequestQuery', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for
     * this to work and must have the can_invite_users administrator right. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $user_id Unique identifier of the target user
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#approvechatjoinrequest
     */
    public function approveChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('approveChatJoinRequest', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to approve a suggested post in a direct messages chat. The bot must have the
     * 'can_post_messages' administrator right in the corresponding channel chat. Returns True on
     * success.
     *
     * @param int $chat_id Unique identifier for the target direct messages chat
     * @param int $message_id Identifier of a suggested post message to approve
     * @param int|null $send_date Optional. Point in time (Unix timestamp) when the post is expected to be
     *        published; omit if the date has already been specified when the suggested post was created. If
     *        specified, then the date must be not more than 2678400 seconds (30 days) in the future.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#approvesuggestedpost
     */
    public function approveSuggestedPost(
        int $chat_id,
        int $message_id,
        ?int $send_date = null,
    ): PromiseInterface {
        return $this->callApi('approveSuggestedPost', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups
     * and channels, the user will not be able to return to the chat on their own using invite links,
     * etc., unless unbanned first. The bot must be an administrator in the chat for this to work and
     * must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target
     *        supergroup or channel in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param int|null $until_date Optional. Date when the user will be unbanned; Unix time. If user is
     *        banned for more than 366 days or less than 30 seconds from the current time they are considered to
     *        be banned forever. Applied for supergroups and channels only.
     * @param bool|null $revoke_messages Optional. Pass True to delete all messages from the chat for the
     *        user that is being removed. If False, the user will be able to see messages in the group that were
     *        sent before the user was removed. Always True for supergroups and channels.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#banchatmember
     */
    public function banChatMember(
        int|string $chat_id,
        int $user_id,
        ?int $until_date = null,
        ?bool $revoke_messages = null,
    ): PromiseInterface {
        return $this->callApi('banChatMember', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned,
     * the owner of the banned chat won't be able to send messages on behalf of any of their channels.
     * The bot must be an administrator in the supergroup or channel for this to work and must have the
     * appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $sender_chat_id Unique identifier of the target sender chat
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#banchatsenderchat
     */
    public function banChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): PromiseInterface {
        return $this->callApi('banChatSenderChat', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to close an open topic in a forum supergroup chat. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights, unless it is the creator of the topic. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#closeforumtopic
     */
    public function closeForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): PromiseInterface {
        return $this->callApi('closeForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to close an open 'General' topic in a forum supergroup chat. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#closegeneralforumtopic
     */
    public function closeGeneralForumTopic(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('closeGeneralForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator
     * in the chat for this to work and must have the appropriate administrator rights. The link can be
     * revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink
     * object.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string|null $name Optional. Invite link name; 0-32 characters
     * @param int|null $expire_date Optional. Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Optional. The maximum number of users that can be members of the chat
     *        simultaneously after joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request Optional. True, if users joining the chat via the link need
     *        to be approved by chat administrators. If True, member_limit can't be specified.
     *
     * @return PromiseInterface<\Telegram\Parts\ChatInviteLink>
     *
     * @link https://core.telegram.org/bots/api#createchatinvitelink
     */
    public function createChatInviteLink(
        int|string $chat_id,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): PromiseInterface {
        return $this->callApi('createChatInviteLink', get_defined_vars(), ['ChatInviteLink']);
    }

    /**
     * Use this method to create a subscription invite link for a channel chat. The bot must have the
     * can_invite_users administrator rights. The link can be edited using the method
     * editChatSubscriptionInviteLink or revoked using the method revokeChatInviteLink. Returns the new
     * invite link as a ChatInviteLink object.
     *
     * @param int|string $chat_id Unique identifier for the target channel chat or username of the target
     *        channel in the format @username
     * @param int $subscription_period The number of seconds the subscription will be active for before the
     *        next payment. Currently, it must always be 2592000 (30 days).
     * @param int $subscription_price The amount of Telegram Stars a user must pay initially and after each
     *        subsequent subscription period to be a member of the chat; 1-10000
     * @param string|null $name Optional. Invite link name; 0-32 characters
     *
     * @return PromiseInterface<\Telegram\Parts\ChatInviteLink>
     *
     * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
     */
    public function createChatSubscriptionInviteLink(
        int|string $chat_id,
        int $subscription_period,
        int $subscription_price,
        ?string $name = null,
    ): PromiseInterface {
        return $this->callApi('createChatSubscriptionInviteLink', get_defined_vars(), ['ChatInviteLink']);
    }

    /**
     * Use this method to create a topic in a forum supergroup chat or a private chat with a user. In
     * the case of a supergroup chat the bot must be an administrator in the chat for this to work and
     * must have the can_manage_topics administrator right. Returns information about the created topic
     * as a ForumTopic object.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param string $name Topic name, 1-128 characters
     * @param int|null $icon_color Optional. Color of the topic icon in RGB format. Currently, must be one
     *        of 7322096 (0x6FB9F0), 16766590 (0xFFD67E), 13338331 (0xCB86DB), 9367192 (0x8EEE98), 16749490
     *        (0xFF93B2), or 16478047 (0xFB6F5F).
     * @param string|null $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown as
     *        the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers.
     *
     * @return PromiseInterface<\Telegram\Parts\ForumTopic>
     *
     * @link https://core.telegram.org/bots/api#createforumtopic
     */
    public function createForumTopic(
        int|string $chat_id,
        string $name,
        ?int $icon_color = null,
        ?string $icon_custom_emoji_id = null,
    ): PromiseInterface {
        return $this->callApi('createForumTopic', get_defined_vars(), ['ForumTopic']);
    }

    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for
     * this to work and must have the can_invite_users administrator right. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $user_id Unique identifier of the target user
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#declinechatjoinrequest
     */
    public function declineChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('declineChatJoinRequest', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to decline a suggested post in a direct messages chat. The bot must have the
     * 'can_manage_direct_messages' administrator right in the corresponding channel chat. Returns True
     * on success.
     *
     * @param int $chat_id Unique identifier for the target direct messages chat
     * @param int $message_id Identifier of a suggested post message to decline
     * @param string|null $comment Optional. Comment for the creator of the suggested post; 0-128
     *        characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#declinesuggestedpost
     */
    public function declineSuggestedPost(
        int $chat_id,
        int $message_id,
        ?string $comment = null,
    ): PromiseInterface {
        return $this->callApi('declineSuggestedPost', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must
     * be an administrator in the chat for this to work and must have the appropriate administrator
     * rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletechatphoto
     */
    public function deleteChatPhoto(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('deleteChatPhoto', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat
     * or a private chat with a user. In the case of a supergroup chat the bot must be an administrator
     * in the chat for this to work and must have the can_delete_messages administrator rights. Returns
     * True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deleteforumtopic
     */
    public function deleteForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): PromiseInterface {
        return $this->callApi('deleteForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns the edited invite link as a ChatInviteLink object.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string $invite_link The invite link to edit
     * @param string|null $name Optional. Invite link name; 0-32 characters
     * @param int|null $expire_date Optional. Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Optional. The maximum number of users that can be members of the chat
     *        simultaneously after joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request Optional. True, if users joining the chat via the link need
     *        to be approved by chat administrators. If True, member_limit can't be specified.
     *
     * @return PromiseInterface<\Telegram\Parts\ChatInviteLink>
     *
     * @link https://core.telegram.org/bots/api#editchatinvitelink
     */
    public function editChatInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): PromiseInterface {
        return $this->callApi('editChatInviteLink', get_defined_vars(), ['ChatInviteLink']);
    }

    /**
     * Use this method to edit a subscription invite link created by the bot. The bot must have the
     * can_invite_users administrator rights. Returns the edited invite link as a ChatInviteLink
     * object.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string $invite_link The invite link to edit
     * @param string|null $name Optional. Invite link name; 0-32 characters
     *
     * @return PromiseInterface<\Telegram\Parts\ChatInviteLink>
     *
     * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
     */
    public function editChatSubscriptionInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
    ): PromiseInterface {
        return $this->callApi('editChatSubscriptionInviteLink', get_defined_vars(), ['ChatInviteLink']);
    }

    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat or a private chat
     * with a user. In the case of a supergroup chat the bot must be an administrator in the chat for
     * this to work and must have the can_manage_topics administrator rights, unless it is the creator
     * of the topic. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @param string|null $name Optional. New topic name, 0-128 characters. If not specified or empty, the
     *        current name of the topic will be kept.
     * @param string|null $icon_custom_emoji_id Optional. New unique identifier of the custom emoji shown
     *        as the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers. Pass
     *        an empty string to remove the icon. If not specified, the current icon will be kept.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editforumtopic
     */
    public function editForumTopic(
        int|string $chat_id,
        int $message_thread_id,
        ?string $name = null,
        ?string $icon_custom_emoji_id = null,
    ): PromiseInterface {
        return $this->callApi('editForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to edit the name of the 'General' topic in a forum supergroup chat. The bot must
     * be an administrator in the chat for this to work and must have the can_manage_topics
     * administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param string $name New topic name, 1-128 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#editgeneralforumtopic
     */
    public function editGeneralForumTopic(
        int|string $chat_id,
        string $name,
    ): PromiseInterface {
        return $this->callApi('editGeneralForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated
     * primary link is revoked. The bot must be an administrator in the chat for this to work and must
     * have the appropriate administrator rights. Returns the new invite link as String on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     *
     * @return PromiseInterface<string>
     *
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     */
    public function exportChatInviteLink(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('exportChatInviteLink', get_defined_vars(), ['String']);
    }

    /**
     * Use this method to get up-to-date information about the chat. Returns a ChatFullInfo object on
     * success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup or channel in the format @username
     *
     * @return PromiseInterface<\Telegram\Parts\ChatFullInfo>
     *
     * @link https://core.telegram.org/bots/api#getchat
     */
    public function getChat(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('getChat', get_defined_vars(), ['ChatFullInfo']);
    }

    /**
     * Use this method to get a list of administrators in a chat. Returns an Array of ChatMember
     * objects.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup or channel in the format @username
     * @param bool|null $return_bots Optional. Pass True to additionally receive all bots that are
     *        administrators of the chat. By default, bots other than the current bot are omitted.
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\ChatMember>>
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     */
    public function getChatAdministrators(
        int|string $chat_id,
        ?bool $return_bots = null,
    ): PromiseInterface {
        return $this->callApi('getChatAdministrators', get_defined_vars(), ['Array of ChatMember']);
    }

    /**
     * Use this method to get information about a member of a chat. The method is only guaranteed to
     * work for other users if the bot is an administrator in the chat. Returns a ChatMember object on
     * success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup or channel in the format @username
     * @param int $user_id Unique identifier of the target user
     *
     * @return PromiseInterface<\Telegram\Parts\ChatMember>
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     */
    public function getChatMember(
        int|string $chat_id,
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('getChatMember', get_defined_vars(), ['ChatMember']);
    }

    /**
     * Use this method to get the number of members in a chat. Returns Integer on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup or channel in the format @username
     *
     * @return PromiseInterface<int>
     *
     * @link https://core.telegram.org/bots/api#getchatmembercount
     */
    public function getChatMemberCount(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('getChatMemberCount', get_defined_vars(), ['Integer']);
    }

    /**
     * Use this method to get the list of boosts added to a chat by a user. Requires administrator
     * rights in the chat. Returns a UserChatBoosts object.
     *
     * @param int|string $chat_id Unique identifier for the chat or username of the channel in the format
     *        @username
     * @param int $user_id Unique identifier of the target user
     *
     * @return PromiseInterface<\Telegram\Parts\UserChatBoosts>
     *
     * @link https://core.telegram.org/bots/api#getuserchatboosts
     */
    public function getUserChatBoosts(
        int|string $chat_id,
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('getUserChatBoosts', get_defined_vars(), ['UserChatBoosts']);
    }

    /**
     * Use this method to get the last messages from the personal chat (i.e., the chat currently added
     * to their profile) of a given user. On success, an Array of Message objects is returned.
     *
     * @param int $user_id Unique identifier for the target user
     * @param int $limit The maximum number of messages to return; 1-20
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\Message>>
     *
     * @link https://core.telegram.org/bots/api#getuserpersonalchatmessages
     */
    public function getUserPersonalChatMessages(
        int $user_id,
        int $limit,
    ): PromiseInterface {
        return $this->callApi('getUserPersonalChatMessages', get_defined_vars(), ['Array of Message']);
    }

    /**
     * Use this method to get a list of profile audios for a user. Returns a UserProfileAudios object.
     *
     * @param int $user_id Unique identifier of the target user
     * @param int|null $offset Optional. Sequential number of the first audio to be returned. By default,
     *        all audios are returned.
     * @param int|null $limit Optional. Limits the number of audios to be retrieved. Values between 1-100
     *        are accepted. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\UserProfileAudios>
     *
     * @link https://core.telegram.org/bots/api#getuserprofileaudios
     */
    public function getUserProfileAudios(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getUserProfileAudios', get_defined_vars(), ['UserProfileAudios']);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos
     * object.
     *
     * @param int $user_id Unique identifier of the target user
     * @param int|null $offset Optional. Sequential number of the first photo to be returned. By default,
     *        all photos are returned.
     * @param int|null $limit Optional. Limits the number of photos to be retrieved. Values between 1-100
     *        are accepted. Defaults to 100.
     *
     * @return PromiseInterface<\Telegram\Parts\UserProfilePhotos>
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     */
    public function getUserProfilePhotos(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): PromiseInterface {
        return $this->callApi('getUserProfilePhotos', get_defined_vars(), ['UserProfilePhotos']);
    }

    /**
     * Use this method to hide the 'General' topic in a forum supergroup chat. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights. The topic will be automatically closed if it was open. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
     */
    public function hideGeneralForumTopic(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('hideGeneralForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup or channel in the format @username. Channel direct messages chats aren't supported; leave
     *        the corresponding channel instead.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#leavechat
     */
    public function leaveChat(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('leaveChat', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     * Pass False for all boolean parameters to demote a user. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $is_anonymous Optional. Pass True if the administrator's presence in the chat is
     *        hidden
     * @param bool|null $can_manage_chat Optional. Pass True if the administrator can access the chat event
     *        log, get boost list, see hidden supergroup and channel members, report spam messages, ignore slow
     *        mode, and send messages to the chat without paying Telegram Stars. Implied by any other
     *        administrator privilege.
     * @param bool|null $can_delete_messages Optional. Pass True if the administrator can delete messages
     *        of other users
     * @param bool|null $can_manage_video_chats Optional. Pass True if the administrator can manage video
     *        chats
     * @param bool|null $can_restrict_members Optional. Pass True if the administrator can restrict, ban or
     *        unban chat members, or access supergroup statistics. For backward compatibility, defaults to True
     *        for promotions of channel administrators.
     * @param bool|null $can_promote_members Optional. Pass True if the administrator can add new
     *        administrators with a subset of their own privileges or demote administrators that they have
     *        promoted, directly or indirectly (promoted by administrators that were appointed by him)
     * @param bool|null $can_change_info Optional. Pass True if the administrator can change chat title,
     *        photo and other settings
     * @param bool|null $can_invite_users Optional. Pass True if the administrator can invite new users to
     *        the chat
     * @param bool|null $can_post_stories Optional. Pass True if the administrator can post stories to the
     *        chat
     * @param bool|null $can_edit_stories Optional. Pass True if the administrator can edit stories posted
     *        by other users, post stories to the chat page, pin chat stories, and access the chat's story archive
     * @param bool|null $can_delete_stories Optional. Pass True if the administrator can delete stories
     *        posted by other users
     * @param bool|null $can_post_messages Optional. Pass True if the administrator can post messages in
     *        the channel, approve suggested posts, or access channel statistics; for channels only
     * @param bool|null $can_edit_messages Optional. Pass True if the administrator can edit messages of
     *        other users and can pin messages; for channels only
     * @param bool|null $can_pin_messages Optional. Pass True if the administrator can pin messages; for
     *        supergroups only
     * @param bool|null $can_manage_topics Optional. Pass True if the user is allowed to create, rename,
     *        close, and reopen forum topics; for supergroups only
     * @param bool|null $can_manage_direct_messages Optional. Pass True if the administrator can manage
     *        direct messages within the channel and decline suggested posts; for channels only
     * @param bool|null $can_manage_tags Optional. Pass True if the administrator can edit the tags of
     *        regular members; for groups and supergroups only
     * @param bool|null $can_send_welcome_messages Optional. Pass True if the administrator can manage chat
     *        welcome messages or directly send them in the case of bots
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#promotechatmember
     */
    public function promoteChatMember(
        int|string $chat_id,
        int $user_id,
        ?bool $is_anonymous = null,
        ?bool $can_manage_chat = null,
        ?bool $can_delete_messages = null,
        ?bool $can_manage_video_chats = null,
        ?bool $can_restrict_members = null,
        ?bool $can_promote_members = null,
        ?bool $can_change_info = null,
        ?bool $can_invite_users = null,
        ?bool $can_post_stories = null,
        ?bool $can_edit_stories = null,
        ?bool $can_delete_stories = null,
        ?bool $can_post_messages = null,
        ?bool $can_edit_messages = null,
        ?bool $can_pin_messages = null,
        ?bool $can_manage_topics = null,
        ?bool $can_manage_direct_messages = null,
        ?bool $can_manage_tags = null,
        ?bool $can_send_welcome_messages = null,
    ): PromiseInterface {
        return $this->callApi('promoteChatMember', get_defined_vars(), ['Boolean']);
    }

    /**
     * Removes verification from a chat that is currently verified on behalf of the organization
     * represented by the bot. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot or
     *        channel in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#removechatverification
     */
    public function removeChatVerification(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('removeChatVerification', get_defined_vars(), ['Boolean']);
    }

    /**
     * Removes verification from a user who is currently verified on behalf of the organization
     * represented by the bot. Returns True on success.
     *
     * @param int $user_id Unique identifier of the target user
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#removeuserverification
     */
    public function removeUserVerification(
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('removeUserVerification', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights, unless it is the creator of the topic. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#reopenforumtopic
     */
    public function reopenForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): PromiseInterface {
        return $this->callApi('reopenForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to reopen a closed 'General' topic in a forum supergroup chat. The bot must be
     * an administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights. The topic will be automatically unhidden if it was hidden. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#reopengeneralforumtopic
     */
    public function reopenGeneralForumTopic(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('reopenGeneralForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the
     * supergroup for this to work and must have the appropriate administrator rights. Pass True for
     * all permissions to lift restrictions from a user. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param \Telegram\Parts\ChatPermissions|array $permissions A JSON-serialized object for new user
     *        permissions
     * @param bool|null $use_independent_chat_permissions Optional. Pass True if chat permissions are set
     *        independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will
     *        imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos,
     *        can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply
     *        the can_send_messages permission.
     * @param int|null $until_date Optional. Date when restrictions will be lifted for the user; Unix time.
     *        If user is restricted for more than 366 days or less than 30 seconds from the current time, they are
     *        considered to be restricted forever.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#restrictchatmember
     */
    public function restrictChatMember(
        int|string $chat_id,
        int $user_id,
        array|\JsonSerializable $permissions,
        ?bool $use_independent_chat_permissions = null,
        ?int $until_date = null,
    ): PromiseInterface {
        return $this->callApi('restrictChatMember', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a
     * new link is automatically generated. The bot must be an administrator in the chat for this to
     * work and must have the appropriate administrator rights. Returns the revoked invite link as
     * ChatInviteLink object.
     *
     * @param int|string $chat_id Unique identifier of the target chat or username of the target channel in
     *        the format @username
     * @param string $invite_link The invite link to revoke
     *
     * @return PromiseInterface<\Telegram\Parts\ChatInviteLink>
     *
     * @link https://core.telegram.org/bots/api#revokechatinvitelink
     */
    public function revokeChatInviteLink(
        int|string $chat_id,
        string $invite_link,
    ): PromiseInterface {
        return $this->callApi('revokeChatInviteLink', get_defined_vars(), ['ChatInviteLink']);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param string $custom_title New custom title for the administrator; 0-16 characters, emoji are not
     *        allowed
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     */
    public function setChatAdministratorCustomTitle(
        int|string $chat_id,
        int $user_id,
        string $custom_title,
    ): PromiseInterface {
        return $this->callApi('setChatAdministratorCustomTitle', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be
     * an administrator in the chat for this to work and must have the appropriate administrator
     * rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string|null $description Optional. New chat description, 0-255 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatdescription
     */
    public function setChatDescription(
        int|string $chat_id,
        ?string $description = null,
    ): PromiseInterface {
        return $this->callApi('setChatDescription', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set a tag for a regular member in a group or a supergroup. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_tags administrator
     * right. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param string|null $tag Optional. New tag for the member; 0-16 characters, emoji are not allowed
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatmembertag
     */
    public function setChatMemberTag(
        int|string $chat_id,
        int $user_id,
        ?string $tag = null,
    ): PromiseInterface {
        return $this->callApi('setChatMemberTag', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an
     * administrator in the group or a supergroup for this to work and must have the
     * can_restrict_members administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param \Telegram\Parts\ChatPermissions|array $permissions A JSON-serialized object for new default
     *        chat permissions
     * @param bool|null $use_independent_chat_permissions Optional. Pass True if chat permissions are set
     *        independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will
     *        imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos,
     *        can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply
     *        the can_send_messages permission.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatpermissions
     */
    public function setChatPermissions(
        int|string $chat_id,
        array|\JsonSerializable $permissions,
        ?bool $use_independent_chat_permissions = null,
    ): PromiseInterface {
        return $this->callApi('setChatPermissions', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private
     * chats. The bot must be an administrator in the chat for this to work and must have the
     * appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param \Telegram\Builders\InputFile $photo New chat photo, uploaded using multipart/form-data
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatphoto
     */
    public function setChatPhoto(
        int|string $chat_id,
        \Telegram\Builders\InputFile $photo,
    ): PromiseInterface {
        return $this->callApi('setChatPhoto', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The
     * bot must be an administrator in the chat for this to work and must have the appropriate
     * administrator rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param string $title New chat title, 1-128 characters
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchattitle
     */
    public function setChatTitle(
        int|string $chat_id,
        string $title,
    ): PromiseInterface {
        return $this->callApi('setChatTitle', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the emoji status for a given user that previously allowed the bot to manage their emoji
     * status via the Mini App method requestEmojiStatusAccess. Returns True on success.
     *
     * @param int $user_id Unique identifier of the target user
     * @param string|null $emoji_status_custom_emoji_id Optional. Custom emoji identifier of the emoji
     *        status to set. Pass an empty string to remove the status.
     * @param int|null $emoji_status_expiration_date Optional. Expiration date of the emoji status, if any
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setuseremojistatus
     */
    public function setUserEmojiStatus(
        int $user_id,
        ?string $emoji_status_custom_emoji_id = null,
        ?int $emoji_status_expiration_date = null,
    ): PromiseInterface {
        return $this->callApi('setUserEmojiStatus', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will not
     * return to the group or channel automatically, but will be able to join via link, etc. The bot
     * must be an administrator for this to work. By default, this method guarantees that after the
     * call the user is not a member of the chat, but will be able to join it. So if the user is a
     * member of the chat they will also be removed from the chat. If you don't want this, use the
     * parameter only_if_banned. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target
     *        supergroup or channel in the format @username
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $only_if_banned Optional. Do nothing if the user is not banned
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     */
    public function unbanChatMember(
        int|string $chat_id,
        int $user_id,
        ?bool $only_if_banned = null,
    ): PromiseInterface {
        return $this->callApi('unbanChatMember', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot
     * must be an administrator for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     *        in the format @username
     * @param int $sender_chat_id Unique identifier of the target sender chat
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unbanchatsenderchat
     */
    public function unbanChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): PromiseInterface {
        return $this->callApi('unbanChatSenderChat', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to unhide the 'General' topic in a forum supergroup chat. The bot must be an
     * administrator in the chat for this to work and must have the can_manage_topics administrator
     * rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unhidegeneralforumtopic
     */
    public function unhideGeneralForumTopic(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('unhideGeneralForumTopic', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to clear the list of pinned messages in a forum topic in a forum supergroup chat
     * or a private chat with a user. In the case of a supergroup chat the bot must be an administrator
     * in the chat for this to work and must have the can_pin_messages administrator right in the
     * supergroup. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
     */
    public function unpinAllForumTopicMessages(
        int|string $chat_id,
        int $message_thread_id,
    ): PromiseInterface {
        return $this->callApi('unpinAllForumTopicMessages', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to clear the list of pinned messages in a General forum topic. The bot must be
     * an administrator in the chat for this to work and must have the can_pin_messages administrator
     * right in the supergroup. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target
     *        supergroup in the format @username
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
     */
    public function unpinAllGeneralForumTopicMessages(
        int|string $chat_id,
    ): PromiseInterface {
        return $this->callApi('unpinAllGeneralForumTopicMessages', get_defined_vars(), ['Boolean']);
    }

    /**
     * Verifies a chat on behalf of the organization which is represented by the bot. Returns True on
     * success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target bot,
     *        supergroup or channel in the format @username. Channel direct messages chats can't be verified.
     * @param string|null $custom_description Optional. Custom description for the verification; 0-70
     *        characters. Must be empty if the organization isn't allowed to provide a custom verification
     *        description.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#verifychat
     */
    public function verifyChat(
        int|string $chat_id,
        ?string $custom_description = null,
    ): PromiseInterface {
        return $this->callApi('verifyChat', get_defined_vars(), ['Boolean']);
    }

    /**
     * Verifies a user on behalf of the organization which is represented by the bot. Returns True on
     * success.
     *
     * @param int $user_id Unique identifier of the target user
     * @param string|null $custom_description Optional. Custom description for the verification; 0-70
     *        characters. Must be empty if the organization isn't allowed to provide a custom verification
     *        description.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#verifyuser
     */
    public function verifyUser(
        int $user_id,
        ?string $custom_description = null,
    ): PromiseInterface {
        return $this->callApi('verifyUser', get_defined_vars(), ['Boolean']);
    }
}
