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
 * This object represents a message.
 *
 * @property int                                                             $message_id Unique message identifier inside this chat; 0 for ephemeral messages. In specific instances (e.g., a message containing a video sent to a big chat), the server might automatically schedule a message instead of sending it immediately. In such cases, this field will be 0 and the relevant message will be unusable until it is actually sent.
 * @property int|null                                                        $message_thread_id Optional. Unique identifier of a message thread or forum topic to which the message belongs; for supergroups and private chats only
 * @property \Telegram\Parts\DirectMessagesTopic|null                        $direct_messages_topic Optional. Information about the direct messages chat topic that contains the message
 * @property \Telegram\Parts\User|null                                       $from Optional. Sender of the message; may be empty for messages sent to channels. For backward compatibility, if the message was sent on behalf of a chat, the field contains a fake sender user in non-channel chats.
 * @property \Telegram\Parts\Chat|null                                       $sender_chat Optional. Sender of the message when sent on behalf of a chat. For example, the supergroup itself for messages sent by its anonymous administrators or a linked channel for messages automatically forwarded to the channel's discussion group. For backward compatibility, if the message was sent on behalf of a chat, the field from contains a fake sender user in non-channel chats.
 * @property int|null                                                        $sender_boost_count Optional. If the sender of the message boosted the chat, the number of boosts added by the user
 * @property \Telegram\Parts\User|null                                       $sender_business_bot Optional. The bot that actually sent the message on behalf of the business account. Available only for outgoing messages sent on behalf of the connected business account.
 * @property string|null                                                     $sender_tag Optional. Tag or custom title of the sender of the message; for supergroups only
 * @property \Telegram\Parts\User|null                                       $receiver_user Optional. For ephemeral messages, the user who received the message
 * @property int|null                                                        $ephemeral_message_id Optional. For ephemeral messages, identifier of the ephemeral message inside this chat. The identifier may be reused for another ephemeral message after the message is deleted or expires.
 * @property \Carbon\CarbonImmutable                                         $date Date the message was sent in Unix time. It is always a positive number, representing a valid date.
 * @property string|null                                                     $guest_query_id Optional. The unique identifier for the guest query. Use this identifier with the method answerGuestQuery to send a response message. If non-empty, the message belongs to the chat where the guest bot was summoned, which may not coincide with other existing bot chats sharing the same identifier.
 * @property string|null                                                     $business_connection_id Optional. Unique identifier of the business connection from which the message was received. If non-empty, the message belongs to a chat of the corresponding business account that is independent from any potential bot chat which might share the same identifier.
 * @property \Telegram\Parts\Chat                                            $chat Chat the message belongs to
 * @property \Telegram\Parts\MessageOrigin|null                              $forward_origin Optional. Information about the original message for forwarded messages
 * @property bool|null                                                       $is_topic_message Optional. True, if the message is sent to a topic in a forum supergroup or a private chat with the bot
 * @property bool|null                                                       $is_automatic_forward Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
 * @property \Telegram\Parts\Message|null                                    $reply_to_message Optional. For replies in the same chat and message thread, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply. If the message is a reply to an ephemeral message, then this field may be omitted.
 * @property \Telegram\Parts\ExternalReplyInfo|null                          $external_reply Optional. Information about the message that is being replied to, which may come from another chat or forum topic
 * @property \Telegram\Parts\TextQuote|null                                  $quote Optional. For replies that quote part of the original message, the quoted part of the message
 * @property \Telegram\Parts\Story|null                                      $reply_to_story Optional. For replies to a story, the original story
 * @property int|null                                                        $reply_to_checklist_task_id Optional. Identifier of the specific checklist task that is being replied to
 * @property string|null                                                     $reply_to_poll_option_id Optional. Persistent identifier of the specific poll option that is being replied to
 * @property \Telegram\Parts\User|null                                       $via_bot Optional. Bot through which the message was sent
 * @property \Telegram\Parts\User|null                                       $guest_bot_caller_user Optional. For a message sent by a guest bot, this is the user whose original message triggered the bot's response
 * @property \Telegram\Parts\Chat|null                                       $guest_bot_caller_chat Optional. For a message sent by a guest bot, this is the chat whose original message triggered the bot's response
 * @property \Carbon\CarbonImmutable|null                                    $edit_date Optional. Date the message was last edited in Unix time
 * @property bool|null                                                       $has_protected_content Optional. True, if the message can't be forwarded
 * @property bool|null                                                       $is_from_offline Optional. True, if the message was sent by an implicit action, for example, as an away or a greeting business message, or as a scheduled message
 * @property bool|null                                                       $is_paid_post Optional. True, if the message is a paid post. Note that such posts must not be deleted for 24 hours to receive the payment and can't be edited.
 * @property string|null                                                     $media_group_id Optional. The unique identifier inside this chat of a media message group this message belongs to
 * @property string|null                                                     $author_signature Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
 * @property int|null                                                        $paid_star_count Optional. The number of Telegram Stars that were paid by the sender of the message to send it
 * @property string|null                                                     $text Optional. For text messages, the actual UTF-8 text of the message
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $entities Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
 * @property \Telegram\Parts\LinkPreviewOptions|null                         $link_preview_options Optional. Options used for link preview generation for the message, if it is a text message and link preview options were changed
 * @property \Telegram\Parts\SuggestedPostInfo|null                          $suggested_post_info Optional. Information about suggested post parameters if the message is a suggested post in a channel direct messages chat. If the message is an approved or declined suggested post, then it can't be edited.
 * @property string|null                                                     $effect_id Optional. Unique identifier of the message effect added to the message
 * @property \Telegram\Parts\RichMessage|null                                $rich_message Optional. Message is a rich formatted message
 * @property \Telegram\Parts\Animation|null                                  $animation Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set.
 * @property \Telegram\Parts\Audio|null                                      $audio Optional. Message is an audio file, information about the file
 * @property \Telegram\Parts\Document|null                                   $document Optional. Message is a general file, information about the file
 * @property \Telegram\Parts\LivePhoto|null                                  $live_photo Optional. Message is a live photo, information about the live photo. For backward compatibility, when this field is set, the photo field will also be set.
 * @property \Telegram\Parts\PaidMediaInfo|null                              $paid_media Optional. Message contains paid media; information about the paid media
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null     $photo Optional. Message is a photo, available sizes of the photo
 * @property \Telegram\Parts\Sticker|null                                    $sticker Optional. Message is a sticker, information about the sticker
 * @property \Telegram\Parts\Story|null                                      $story Optional. Message is a forwarded story
 * @property \Telegram\Parts\Video|null                                      $video Optional. Message is a video, information about the video
 * @property \Telegram\Parts\VideoNote|null                                  $video_note Optional. Message is a video note, information about the video message
 * @property \Telegram\Parts\Voice|null                                      $voice Optional. Message is a voice message, information about the file
 * @property string|null                                                     $caption Optional. Caption for the animation, audio, document, paid media, photo, video or voice
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $caption_entities Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
 * @property bool|null                                                       $show_caption_above_media Optional. True, if the caption must be shown above the message media
 * @property bool|null                                                       $has_media_spoiler Optional. True, if the message media is covered by a spoiler animation
 * @property \Telegram\Parts\Checklist|null                                  $checklist Optional. Message is a checklist
 * @property \Telegram\Parts\Contact|null                                    $contact Optional. Message is a shared contact, information about the contact
 * @property \Telegram\Parts\Dice|null                                       $dice Optional. Message is a dice with random value
 * @property \Telegram\Parts\Game|null                                       $game Optional. Message is a game, information about the game. More about games: https://core.telegram.org/bots/api#games
 * @property \Telegram\Parts\Poll|null                                       $poll Optional. Message is a native poll, information about the poll
 * @property \Telegram\Parts\Venue|null                                      $venue Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set.
 * @property \Telegram\Parts\Location|null                                   $location Optional. Message is a shared location, information about the location
 * @property \Discord\Helpers\Collection<\Telegram\Parts\User>|null          $new_chat_members Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
 * @property \Telegram\Parts\User|null                                       $left_chat_member Optional. A member was removed from the group, information about them (this member may be the bot itself)
 * @property \Telegram\Parts\ChatOwnerLeft|null                              $chat_owner_left Optional. Service message: chat owner has left
 * @property \Telegram\Parts\ChatOwnerChanged|null                           $chat_owner_changed Optional. Service message: chat owner has changed
 * @property string|null                                                     $new_chat_title Optional. A chat title was changed to this value
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null     $new_chat_photo Optional. A chat photo was change to this value
 * @property bool|null                                                       $delete_chat_photo Optional. Service message: the chat photo was deleted
 * @property bool|null                                                       $group_chat_created Optional. Service message: the group has been created
 * @property bool|null                                                       $supergroup_chat_created Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
 * @property bool|null                                                       $channel_chat_created Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
 * @property \Telegram\Parts\MessageAutoDeleteTimerChanged|null              $message_auto_delete_timer_changed Optional. Service message: auto-delete timer settings changed in the chat
 * @property int|null                                                        $migrate_to_chat_id Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property int|null                                                        $migrate_from_chat_id Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property \Telegram\Parts\MaybeInaccessibleMessage|null                   $pinned_message Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
 * @property \Telegram\Parts\Invoice|null                                    $invoice Optional. Message is an invoice for a payment, information about the invoice. More about payments: https://core.telegram.org/bots/api#payments
 * @property \Telegram\Parts\SuccessfulPayment|null                          $successful_payment Optional. Message is a service message about a successful payment, information about the payment. More about payments: https://core.telegram.org/bots/api#payments
 * @property \Telegram\Parts\RefundedPayment|null                            $refunded_payment Optional. Message is a service message about a refunded payment, information about the payment. More about payments: https://core.telegram.org/bots/api#payments
 * @property \Telegram\Parts\UsersShared|null                                $users_shared Optional. Service message: users were shared with the bot
 * @property \Telegram\Parts\ChatShared|null                                 $chat_shared Optional. Service message: a chat was shared with the bot
 * @property \Telegram\Parts\GiftInfo|null                                   $gift Optional. Service message: a regular gift was sent or received
 * @property \Telegram\Parts\UniqueGiftInfo|null                             $unique_gift Optional. Service message: a unique gift was sent or received
 * @property \Telegram\Parts\GiftInfo|null                                   $gift_upgrade_sent Optional. Service message: upgrade of a gift was purchased after the gift was sent
 * @property string|null                                                     $connected_website Optional. The domain name of the website on which the user has logged in. More about Telegram Login: https://core.telegram.org/widgets/login
 * @property \Telegram\Parts\WriteAccessAllowed|null                         $write_access_allowed Optional. Service message: the user allowed the bot to write messages after adding it to the attachment or side menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method requestWriteAccess
 * @property \Telegram\Parts\PassportData|null                               $passport_data Optional. Telegram Passport data
 * @property \Telegram\Parts\ProximityAlertTriggered|null                    $proximity_alert_triggered Optional. Service message: a user in the chat triggered another user's proximity alert while sharing Live Location
 * @property \Telegram\Parts\ChatBoostAdded|null                             $boost_added Optional. Service message: user boosted the chat
 * @property \Telegram\Parts\ChatBackground|null                             $chat_background_set Optional. Service message: chat background set
 * @property \Telegram\Parts\ChecklistTasksDone|null                         $checklist_tasks_done Optional. Service message: some tasks in a checklist were marked as done or not done
 * @property \Telegram\Parts\ChecklistTasksAdded|null                        $checklist_tasks_added Optional. Service message: tasks were added to a checklist
 * @property \Telegram\Parts\CommunityChatAdded|null                         $community_chat_added Optional. Service message: chat or bot added to a Community
 * @property \Telegram\Parts\CommunityChatJoined|null                        $community_chat_joined Optional. Service message: chat was joined by a user from a Community
 * @property \Telegram\Parts\CommunityChatRemoved|null                       $community_chat_removed Optional. Service message: chat or bot removed from a Community
 * @property \Telegram\Parts\DirectMessagePriceChanged|null                  $direct_message_price_changed Optional. Service message: the price for paid messages in the corresponding direct messages chat of a channel has changed
 * @property \Telegram\Parts\ForumTopicCreated|null                          $forum_topic_created Optional. Service message: forum topic created
 * @property \Telegram\Parts\ForumTopicEdited|null                           $forum_topic_edited Optional. Service message: forum topic edited
 * @property \Telegram\Parts\ForumTopicClosed|null                           $forum_topic_closed Optional. Service message: forum topic closed
 * @property \Telegram\Parts\ForumTopicReopened|null                         $forum_topic_reopened Optional. Service message: forum topic reopened
 * @property \Telegram\Parts\GeneralForumTopicHidden|null                    $general_forum_topic_hidden Optional. Service message: the 'General' forum topic hidden
 * @property \Telegram\Parts\GeneralForumTopicUnhidden|null                  $general_forum_topic_unhidden Optional. Service message: the 'General' forum topic unhidden
 * @property \Telegram\Parts\GiveawayCreated|null                            $giveaway_created Optional. Service message: a scheduled giveaway was created
 * @property \Telegram\Parts\Giveaway|null                                   $giveaway Optional. The message is a scheduled giveaway message
 * @property \Telegram\Parts\GiveawayWinners|null                            $giveaway_winners Optional. A giveaway with public winners was completed
 * @property \Telegram\Parts\GiveawayCompleted|null                          $giveaway_completed Optional. Service message: a giveaway without public winners was completed
 * @property \Telegram\Parts\ManagedBotCreated|null                          $managed_bot_created Optional. Service message: user created a bot that will be managed by the current bot
 * @property \Telegram\Parts\PaidMessagePriceChanged|null                    $paid_message_price_changed Optional. Service message: the price for paid messages has changed in the chat
 * @property \Telegram\Parts\PollOptionAdded|null                            $poll_option_added Optional. Service message: answer option was added to a poll
 * @property \Telegram\Parts\PollOptionDeleted|null                          $poll_option_deleted Optional. Service message: answer option was deleted from a poll
 * @property \Telegram\Parts\SuggestedPostApproved|null                      $suggested_post_approved Optional. Service message: a suggested post was approved
 * @property \Telegram\Parts\SuggestedPostApprovalFailed|null                $suggested_post_approval_failed Optional. Service message: approval of a suggested post has failed
 * @property \Telegram\Parts\SuggestedPostDeclined|null                      $suggested_post_declined Optional. Service message: a suggested post was declined
 * @property \Telegram\Parts\SuggestedPostPaid|null                          $suggested_post_paid Optional. Service message: payment for a suggested post was received
 * @property \Telegram\Parts\SuggestedPostRefunded|null                      $suggested_post_refunded Optional. Service message: payment for a suggested post was refunded
 * @property \Telegram\Parts\VideoChatScheduled|null                         $video_chat_scheduled Optional. Service message: video chat scheduled
 * @property \Telegram\Parts\VideoChatStarted|null                           $video_chat_started Optional. Service message: video chat started
 * @property \Telegram\Parts\VideoChatEnded|null                             $video_chat_ended Optional. Service message: video chat ended
 * @property \Telegram\Parts\VideoChatParticipantsInvited|null               $video_chat_participants_invited Optional. Service message: new participants invited to a video chat
 * @property \Telegram\Parts\WebAppData|null                                 $web_app_data Optional. Service message: data sent by a Web App
 * @property \Telegram\Parts\InlineKeyboardMarkup|null                       $reply_markup Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
 *
 * @link https://core.telegram.org/bots/api#message
 *
 * @since v10.3
 */
class Message extends MaybeInaccessibleMessage
{
    use Concerns\MessageBehaviour;

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'message_id',
        'message_thread_id',
        'direct_messages_topic',
        'from',
        'sender_chat',
        'sender_boost_count',
        'sender_business_bot',
        'sender_tag',
        'receiver_user',
        'ephemeral_message_id',
        'date',
        'guest_query_id',
        'business_connection_id',
        'chat',
        'forward_origin',
        'is_topic_message',
        'is_automatic_forward',
        'reply_to_message',
        'external_reply',
        'quote',
        'reply_to_story',
        'reply_to_checklist_task_id',
        'reply_to_poll_option_id',
        'via_bot',
        'guest_bot_caller_user',
        'guest_bot_caller_chat',
        'edit_date',
        'has_protected_content',
        'is_from_offline',
        'is_paid_post',
        'media_group_id',
        'author_signature',
        'paid_star_count',
        'text',
        'entities',
        'link_preview_options',
        'suggested_post_info',
        'effect_id',
        'rich_message',
        'animation',
        'audio',
        'document',
        'live_photo',
        'paid_media',
        'photo',
        'sticker',
        'story',
        'video',
        'video_note',
        'voice',
        'caption',
        'caption_entities',
        'show_caption_above_media',
        'has_media_spoiler',
        'checklist',
        'contact',
        'dice',
        'game',
        'poll',
        'venue',
        'location',
        'new_chat_members',
        'left_chat_member',
        'chat_owner_left',
        'chat_owner_changed',
        'new_chat_title',
        'new_chat_photo',
        'delete_chat_photo',
        'group_chat_created',
        'supergroup_chat_created',
        'channel_chat_created',
        'message_auto_delete_timer_changed',
        'migrate_to_chat_id',
        'migrate_from_chat_id',
        'pinned_message',
        'invoice',
        'successful_payment',
        'refunded_payment',
        'users_shared',
        'chat_shared',
        'gift',
        'unique_gift',
        'gift_upgrade_sent',
        'connected_website',
        'write_access_allowed',
        'passport_data',
        'proximity_alert_triggered',
        'boost_added',
        'chat_background_set',
        'checklist_tasks_done',
        'checklist_tasks_added',
        'community_chat_added',
        'community_chat_joined',
        'community_chat_removed',
        'direct_message_price_changed',
        'forum_topic_created',
        'forum_topic_edited',
        'forum_topic_closed',
        'forum_topic_reopened',
        'general_forum_topic_hidden',
        'general_forum_topic_unhidden',
        'giveaway_created',
        'giveaway',
        'giveaway_winners',
        'giveaway_completed',
        'managed_bot_created',
        'paid_message_price_changed',
        'poll_option_added',
        'poll_option_deleted',
        'suggested_post_approved',
        'suggested_post_approval_failed',
        'suggested_post_declined',
        'suggested_post_paid',
        'suggested_post_refunded',
        'video_chat_scheduled',
        'video_chat_started',
        'video_chat_ended',
        'video_chat_participants_invited',
        'web_app_data',
        'reply_markup',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'direct_messages_topic'             => 'DirectMessagesTopic',
        'from'                              => 'User',
        'sender_chat'                       => 'Chat',
        'sender_business_bot'               => 'User',
        'receiver_user'                     => 'User',
        'chat'                              => 'Chat',
        'forward_origin'                    => 'MessageOrigin',
        'reply_to_message'                  => 'Message',
        'external_reply'                    => 'ExternalReplyInfo',
        'quote'                             => 'TextQuote',
        'reply_to_story'                    => 'Story',
        'via_bot'                           => 'User',
        'guest_bot_caller_user'             => 'User',
        'guest_bot_caller_chat'             => 'Chat',
        'entities'                          => 'Array of MessageEntity',
        'link_preview_options'              => 'LinkPreviewOptions',
        'suggested_post_info'               => 'SuggestedPostInfo',
        'rich_message'                      => 'RichMessage',
        'animation'                         => 'Animation',
        'audio'                             => 'Audio',
        'document'                          => 'Document',
        'live_photo'                        => 'LivePhoto',
        'paid_media'                        => 'PaidMediaInfo',
        'photo'                             => 'Array of PhotoSize',
        'sticker'                           => 'Sticker',
        'story'                             => 'Story',
        'video'                             => 'Video',
        'video_note'                        => 'VideoNote',
        'voice'                             => 'Voice',
        'caption_entities'                  => 'Array of MessageEntity',
        'checklist'                         => 'Checklist',
        'contact'                           => 'Contact',
        'dice'                              => 'Dice',
        'game'                              => 'Game',
        'poll'                              => 'Poll',
        'venue'                             => 'Venue',
        'location'                          => 'Location',
        'new_chat_members'                  => 'Array of User',
        'left_chat_member'                  => 'User',
        'chat_owner_left'                   => 'ChatOwnerLeft',
        'chat_owner_changed'                => 'ChatOwnerChanged',
        'new_chat_photo'                    => 'Array of PhotoSize',
        'message_auto_delete_timer_changed' => 'MessageAutoDeleteTimerChanged',
        'pinned_message'                    => 'MaybeInaccessibleMessage',
        'invoice'                           => 'Invoice',
        'successful_payment'                => 'SuccessfulPayment',
        'refunded_payment'                  => 'RefundedPayment',
        'users_shared'                      => 'UsersShared',
        'chat_shared'                       => 'ChatShared',
        'gift'                              => 'GiftInfo',
        'unique_gift'                       => 'UniqueGiftInfo',
        'gift_upgrade_sent'                 => 'GiftInfo',
        'write_access_allowed'              => 'WriteAccessAllowed',
        'passport_data'                     => 'PassportData',
        'proximity_alert_triggered'         => 'ProximityAlertTriggered',
        'boost_added'                       => 'ChatBoostAdded',
        'chat_background_set'               => 'ChatBackground',
        'checklist_tasks_done'              => 'ChecklistTasksDone',
        'checklist_tasks_added'             => 'ChecklistTasksAdded',
        'community_chat_added'              => 'CommunityChatAdded',
        'community_chat_joined'             => 'CommunityChatJoined',
        'community_chat_removed'            => 'CommunityChatRemoved',
        'direct_message_price_changed'      => 'DirectMessagePriceChanged',
        'forum_topic_created'               => 'ForumTopicCreated',
        'forum_topic_edited'                => 'ForumTopicEdited',
        'forum_topic_closed'                => 'ForumTopicClosed',
        'forum_topic_reopened'              => 'ForumTopicReopened',
        'general_forum_topic_hidden'        => 'GeneralForumTopicHidden',
        'general_forum_topic_unhidden'      => 'GeneralForumTopicUnhidden',
        'giveaway_created'                  => 'GiveawayCreated',
        'giveaway'                          => 'Giveaway',
        'giveaway_winners'                  => 'GiveawayWinners',
        'giveaway_completed'                => 'GiveawayCompleted',
        'managed_bot_created'               => 'ManagedBotCreated',
        'paid_message_price_changed'        => 'PaidMessagePriceChanged',
        'poll_option_added'                 => 'PollOptionAdded',
        'poll_option_deleted'               => 'PollOptionDeleted',
        'suggested_post_approved'           => 'SuggestedPostApproved',
        'suggested_post_approval_failed'    => 'SuggestedPostApprovalFailed',
        'suggested_post_declined'           => 'SuggestedPostDeclined',
        'suggested_post_paid'               => 'SuggestedPostPaid',
        'suggested_post_refunded'           => 'SuggestedPostRefunded',
        'video_chat_scheduled'              => 'VideoChatScheduled',
        'video_chat_started'                => 'VideoChatStarted',
        'video_chat_ended'                  => 'VideoChatEnded',
        'video_chat_participants_invited'   => 'VideoChatParticipantsInvited',
        'web_app_data'                      => 'WebAppData',
        'reply_markup'                      => 'InlineKeyboardMarkup',
    ];

    /** @var list<string> */
    protected array $dates = [
        'date',
        'edit_date',
    ];
}
