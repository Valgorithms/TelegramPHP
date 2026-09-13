<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Events;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * The update types a bot can receive, which are also the event names
 * {@see \Telegram\Telegram} emits:
 *
 * ```php
 * $telegram->on(Event::MESSAGE, function (Message $message) {
 *     $message->reply('hello');
 * });
 * ```
 *
 * The same strings go in the `allowed_updates` array of `getUpdates` and
 * `setWebhook`; {@see all()} is the full list.
 *
 * @link https://core.telegram.org/bots/api#update
 *
 * @since Bot API 10.3
 */
final class Event
{
    /** Emitted for every update, whatever its type, with the Update part. */
    public const UPDATE = 'update';

    /** Emitted once the bot has identified itself and updates are flowing. */
    public const READY = 'ready';

    /** Emitted with any error the client could not hand to a caller. */
    public const ERROR = 'error';

    /** New incoming message of any kind - text, photo, sticker, etc. */
    public const MESSAGE                    = 'message';

    /** New version of a message that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot. */
    public const EDITED_MESSAGE             = 'edited_message';

    /** New incoming channel post of any kind - text, photo, sticker, etc. */
    public const CHANNEL_POST               = 'channel_post';

    /** New version of a channel post that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot. */
    public const EDITED_CHANNEL_POST        = 'edited_channel_post';

    /** The bot was connected to or disconnected from a business account, or a user edited an existing connection with the bot */
    public const BUSINESS_CONNECTION        = 'business_connection';

    /** New message from a connected business account */
    public const BUSINESS_MESSAGE           = 'business_message';

    /** New version of a message from a connected business account */
    public const EDITED_BUSINESS_MESSAGE    = 'edited_business_message';

    /** Messages were deleted from a connected business account */
    public const DELETED_BUSINESS_MESSAGES  = 'deleted_business_messages';

    /** New guest message. The bot can use the field Message.guest_query_id and the method answerGuestQuery to send a message in response. */
    public const GUEST_MESSAGE              = 'guest_message';

    /** A reaction to a message was changed by a user. The bot must be an administrator in the chat and must explicitly specify "message_reaction" in the list of allowed_updates to receive these updates. The update isn't received for reactions set by bots. */
    public const MESSAGE_REACTION           = 'message_reaction';

    /** Reactions to a message with anonymous reactions were changed. The bot must be an administrator in the chat and must explicitly specify "message_reaction_count" in the list of allowed_updates to receive these updates. The updates are grouped and can be sent with delay up to a few minutes. */
    public const MESSAGE_REACTION_COUNT     = 'message_reaction_count';

    /** New incoming inline query */
    public const INLINE_QUERY               = 'inline_query';

    /** The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot. */
    public const CHOSEN_INLINE_RESULT       = 'chosen_inline_result';

    /** New incoming callback query */
    public const CALLBACK_QUERY             = 'callback_query';

    /** New incoming shipping query. Only for invoices with flexible price. */
    public const SHIPPING_QUERY             = 'shipping_query';

    /** New incoming pre-checkout query. Contains full information about checkout. */
    public const PRE_CHECKOUT_QUERY         = 'pre_checkout_query';

    /** A user purchased paid media with a non-empty payload sent by the bot in a non-channel chat */
    public const PURCHASED_PAID_MEDIA       = 'purchased_paid_media';

    /** New poll state. Bots receive only updates about manually stopped polls and polls, which are sent by the bot. */
    public const POLL                       = 'poll';

    /** A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself. */
    public const POLL_ANSWER                = 'poll_answer';

    /** The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user. */
    public const MY_CHAT_MEMBER             = 'my_chat_member';

    /** A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates. */
    public const CHAT_MEMBER                = 'chat_member';

    /** A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates. */
    public const CHAT_JOIN_REQUEST          = 'chat_join_request';

    /** A chat boost was added or changed. The bot must be an administrator in the chat to receive these updates. */
    public const CHAT_BOOST                 = 'chat_boost';

    /** A boost was removed from a chat. The bot must be an administrator in the chat to receive these updates. */
    public const REMOVED_CHAT_BOOST         = 'removed_chat_boost';

    /** A new bot was created to be managed by the bot, or token or owner of a managed bot was changed */
    public const MANAGED_BOT                = 'managed_bot';

    /** User payment subscription has changed */
    public const SUBSCRIPTION               = 'subscription';

    /** A user asked the bot to stop the generation of a message */
    public const STOPPED_MESSAGE_GENERATION = 'stopped_message_generation';

    /** @var array<string, string> Update field => the part class it carries. */
    public const PAYLOAD_TYPES = [
        'message' => 'Message',
        'edited_message' => 'Message',
        'channel_post' => 'Message',
        'edited_channel_post' => 'Message',
        'business_connection' => 'BusinessConnection',
        'business_message' => 'Message',
        'edited_business_message' => 'Message',
        'deleted_business_messages' => 'BusinessMessagesDeleted',
        'guest_message' => 'Message',
        'message_reaction' => 'MessageReactionUpdated',
        'message_reaction_count' => 'MessageReactionCountUpdated',
        'inline_query' => 'InlineQuery',
        'chosen_inline_result' => 'ChosenInlineResult',
        'callback_query' => 'CallbackQuery',
        'shipping_query' => 'ShippingQuery',
        'pre_checkout_query' => 'PreCheckoutQuery',
        'purchased_paid_media' => 'PaidMediaPurchased',
        'poll' => 'Poll',
        'poll_answer' => 'PollAnswer',
        'my_chat_member' => 'ChatMemberUpdated',
        'chat_member' => 'ChatMemberUpdated',
        'chat_join_request' => 'ChatJoinRequest',
        'chat_boost' => 'ChatBoostUpdated',
        'removed_chat_boost' => 'ChatBoostRemoved',
        'managed_bot' => 'ManagedBotUpdated',
        'subscription' => 'BotSubscriptionUpdated',
        'stopped_message_generation' => 'MessageGenerationStopped',
    ];

    /** @return list<string> Every update type, for `allowed_updates`. */
    public static function all(): array
    {
        return array_keys(self::PAYLOAD_TYPES);
    }
}
