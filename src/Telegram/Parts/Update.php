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
 * This object represents an incoming update.
 * At most one of the optional fields can be present in any given update.
 *
 * @property int                                              $update_id The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This identifier becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
 * @property \Telegram\Parts\Message|null                     $message Optional. New incoming message of any kind - text, photo, sticker, etc.
 * @property \Telegram\Parts\Message|null                     $edited_message Optional. New version of a message that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
 * @property \Telegram\Parts\Message|null                     $channel_post Optional. New incoming channel post of any kind - text, photo, sticker, etc.
 * @property \Telegram\Parts\Message|null                     $edited_channel_post Optional. New version of a channel post that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
 * @property \Telegram\Parts\BusinessConnection|null          $business_connection Optional. The bot was connected to or disconnected from a business account, or a user edited an existing connection with the bot
 * @property \Telegram\Parts\Message|null                     $business_message Optional. New message from a connected business account
 * @property \Telegram\Parts\Message|null                     $edited_business_message Optional. New version of a message from a connected business account
 * @property \Telegram\Parts\BusinessMessagesDeleted|null     $deleted_business_messages Optional. Messages were deleted from a connected business account
 * @property \Telegram\Parts\Message|null                     $guest_message Optional. New guest message. The bot can use the field Message.guest_query_id and the method answerGuestQuery to send a message in response.
 * @property \Telegram\Parts\MessageReactionUpdated|null      $message_reaction Optional. A reaction to a message was changed by a user. The bot must be an administrator in the chat and must explicitly specify "message_reaction" in the list of allowed_updates to receive these updates. The update isn't received for reactions set by bots.
 * @property \Telegram\Parts\MessageReactionCountUpdated|null $message_reaction_count Optional. Reactions to a message with anonymous reactions were changed. The bot must be an administrator in the chat and must explicitly specify "message_reaction_count" in the list of allowed_updates to receive these updates. The updates are grouped and can be sent with delay up to a few minutes.
 * @property \Telegram\Parts\InlineQuery|null                 $inline_query Optional. New incoming inline query
 * @property \Telegram\Parts\ChosenInlineResult|null          $chosen_inline_result Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
 * @property \Telegram\Parts\CallbackQuery|null               $callback_query Optional. New incoming callback query
 * @property \Telegram\Parts\ShippingQuery|null               $shipping_query Optional. New incoming shipping query. Only for invoices with flexible price.
 * @property \Telegram\Parts\PreCheckoutQuery|null            $pre_checkout_query Optional. New incoming pre-checkout query. Contains full information about checkout.
 * @property \Telegram\Parts\PaidMediaPurchased|null          $purchased_paid_media Optional. A user purchased paid media with a non-empty payload sent by the bot in a non-channel chat
 * @property \Telegram\Parts\Poll|null                        $poll Optional. New poll state. Bots receive only updates about manually stopped polls and polls, which are sent by the bot.
 * @property \Telegram\Parts\PollAnswer|null                  $poll_answer Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
 * @property \Telegram\Parts\ChatMemberUpdated|null           $my_chat_member Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
 * @property \Telegram\Parts\ChatMemberUpdated|null           $chat_member Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
 * @property \Telegram\Parts\ChatJoinRequest|null             $chat_join_request Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
 * @property \Telegram\Parts\ChatBoostUpdated|null            $chat_boost Optional. A chat boost was added or changed. The bot must be an administrator in the chat to receive these updates.
 * @property \Telegram\Parts\ChatBoostRemoved|null            $removed_chat_boost Optional. A boost was removed from a chat. The bot must be an administrator in the chat to receive these updates.
 * @property \Telegram\Parts\ManagedBotUpdated|null           $managed_bot Optional. A new bot was created to be managed by the bot, or token or owner of a managed bot was changed
 * @property \Telegram\Parts\BotSubscriptionUpdated|null      $subscription Optional. User payment subscription has changed
 * @property \Telegram\Parts\MessageGenerationStopped|null    $stopped_message_generation Optional. A user asked the bot to stop the generation of a message
 *
 * @link https://core.telegram.org/bots/api#update
 *
 * @since v10.3
 */
class Update extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'update_id',
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'business_connection',
        'business_message',
        'edited_business_message',
        'deleted_business_messages',
        'guest_message',
        'message_reaction',
        'message_reaction_count',
        'inline_query',
        'chosen_inline_result',
        'callback_query',
        'shipping_query',
        'pre_checkout_query',
        'purchased_paid_media',
        'poll',
        'poll_answer',
        'my_chat_member',
        'chat_member',
        'chat_join_request',
        'chat_boost',
        'removed_chat_boost',
        'managed_bot',
        'subscription',
        'stopped_message_generation',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'message'                    => 'Message',
        'edited_message'             => 'Message',
        'channel_post'               => 'Message',
        'edited_channel_post'        => 'Message',
        'business_connection'        => 'BusinessConnection',
        'business_message'           => 'Message',
        'edited_business_message'    => 'Message',
        'deleted_business_messages'  => 'BusinessMessagesDeleted',
        'guest_message'              => 'Message',
        'message_reaction'           => 'MessageReactionUpdated',
        'message_reaction_count'     => 'MessageReactionCountUpdated',
        'inline_query'               => 'InlineQuery',
        'chosen_inline_result'       => 'ChosenInlineResult',
        'callback_query'             => 'CallbackQuery',
        'shipping_query'             => 'ShippingQuery',
        'pre_checkout_query'         => 'PreCheckoutQuery',
        'purchased_paid_media'       => 'PaidMediaPurchased',
        'poll'                       => 'Poll',
        'poll_answer'                => 'PollAnswer',
        'my_chat_member'             => 'ChatMemberUpdated',
        'chat_member'                => 'ChatMemberUpdated',
        'chat_join_request'          => 'ChatJoinRequest',
        'chat_boost'                 => 'ChatBoostUpdated',
        'removed_chat_boost'         => 'ChatBoostRemoved',
        'managed_bot'                => 'ManagedBotUpdated',
        'subscription'               => 'BotSubscriptionUpdated',
        'stopped_message_generation' => 'MessageGenerationStopped',
    ];
}
