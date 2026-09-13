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
 * This object contains full information about a chat.
 *
 * @property int                                                            $id Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property string                                                         $type Type of the chat, can be either "private", "group", "supergroup" or "channel"
 * @property string|null                                                    $title Optional. Title, for supergroups, channels and group chats
 * @property string|null                                                    $username Optional. Username, for private chats, supergroups and channels if available
 * @property string|null                                                    $first_name Optional. First name of the other party in a private chat
 * @property string|null                                                    $last_name Optional. Last name of the other party in a private chat
 * @property bool|null                                                      $is_forum Optional. True, if the supergroup chat is a forum (has topics enabled)
 * @property bool|null                                                      $is_direct_messages Optional. True, if the chat is the direct messages chat of a channel
 * @property int                                                            $accent_color_id Identifier of the accent color for the chat name and backgrounds of the chat photo, reply header, and link preview. See accent colors for more details.
 * @property int                                                            $max_reaction_count The maximum number of reactions that can be set on a message in the chat
 * @property \Telegram\Parts\ChatPhoto|null                                 $photo Optional. Chat photo
 * @property array<int, string>|null                                        $active_usernames Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels
 * @property \Telegram\Parts\Birthdate|null                                 $birthdate Optional. For private chats, the date of birth of the user
 * @property \Telegram\Parts\BusinessIntro|null                             $business_intro Optional. For private chats with business accounts, the intro of the business
 * @property \Telegram\Parts\BusinessLocation|null                          $business_location Optional. For private chats with business accounts, the location of the business
 * @property \Telegram\Parts\BusinessOpeningHours|null                      $business_opening_hours Optional. For private chats with business accounts, the opening hours of the business
 * @property \Telegram\Parts\Chat|null                                      $personal_chat Optional. For private chats, the personal channel of the user
 * @property \Telegram\Parts\Chat|null                                      $parent_chat Optional. Information about the corresponding channel chat; for direct messages chats only
 * @property \Discord\Helpers\Collection<\Telegram\Parts\ReactionType>|null $available_reactions Optional. List of available reactions allowed in the chat. If omitted, then all emoji reactions are allowed.
 * @property string|null                                                    $background_custom_emoji_id Optional. Custom emoji identifier of the emoji chosen by the chat for the reply header and link preview background
 * @property int|null                                                       $profile_accent_color_id Optional. Identifier of the accent color for the chat's profile background. See profile accent colors for more details.
 * @property string|null                                                    $profile_background_custom_emoji_id Optional. Custom emoji identifier of the emoji chosen by the chat for its profile background
 * @property string|null                                                    $emoji_status_custom_emoji_id Optional. Custom emoji identifier of the emoji status of the chat or the other party in a private chat
 * @property \Carbon\CarbonImmutable|null                                   $emoji_status_expiration_date Optional. Expiration date of the emoji status of the chat or the other party in a private chat, in Unix time, if any
 * @property string|null                                                    $bio Optional. Bio of the other party in a private chat
 * @property bool|null                                                      $has_private_forwards Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user
 * @property bool|null                                                      $has_restricted_voice_and_video_messages Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat
 * @property bool|null                                                      $join_to_send_messages Optional. True, if users need to join the supergroup before they can send messages
 * @property bool|null                                                      $join_by_request Optional. True, if all users directly joining the supergroup without using an invite link need to be approved by supergroup administrators
 * @property string|null                                                    $description Optional. Description, for groups, supergroups and channel chats
 * @property string|null                                                    $invite_link Optional. Primary invite link, for groups, supergroups and channel chats
 * @property \Telegram\Parts\Message|null                                   $pinned_message Optional. The most recent pinned message (by sending date)
 * @property \Telegram\Parts\ChatPermissions|null                           $permissions Optional. Default chat member permissions, for groups and supergroups
 * @property \Telegram\Parts\AcceptedGiftTypes                              $accepted_gift_types Information about types of gifts that are accepted by the chat or by the corresponding user for private chats
 * @property bool|null                                                      $can_send_paid_media Optional. True, if paid media messages can be sent or forwarded to the channel chat. The field is available only for channel chats.
 * @property int|null                                                       $slow_mode_delay Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unprivileged user; in seconds
 * @property int|null                                                       $unrestrict_boost_count Optional. For supergroups, the minimum number of boosts that a non-administrator user needs to add in order to ignore slow mode and chat permissions
 * @property int|null                                                       $message_auto_delete_time Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds
 * @property bool|null                                                      $has_aggressive_anti_spam_enabled Optional. True, if aggressive anti-spam checks are enabled in the supergroup. The field is only available to chat administrators.
 * @property bool|null                                                      $has_hidden_members Optional. True, if non-administrators can only get the list of bots and administrators in the chat
 * @property bool|null                                                      $has_protected_content Optional. True, if messages from the chat can't be forwarded to other chats
 * @property bool|null                                                      $has_visible_history Optional. True, if new chat members will have access to old messages; available only to chat administrators
 * @property string|null                                                    $sticker_set_name Optional. For supergroups, name of the group sticker set
 * @property bool|null                                                      $can_set_sticker_set Optional. True, if the bot can change the group sticker set
 * @property string|null                                                    $custom_emoji_sticker_set_name Optional. For supergroups, the name of the group's custom emoji sticker set. Custom emoji from this set can be used by all users and bots in the group.
 * @property int|null                                                       $linked_chat_id Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 * @property \Telegram\Parts\ChatLocation|null                              $location Optional. For supergroups, the location to which the supergroup is connected
 * @property \Telegram\Parts\UserRating|null                                $rating Optional. For private chats, the rating of the user if any
 * @property \Telegram\Parts\Audio|null                                     $first_profile_audio Optional. For private chats, the first audio added to the profile of the user
 * @property \Telegram\Parts\UniqueGiftColors|null                          $unique_gift_colors Optional. The color scheme based on a unique gift that must be used for the chat's name, message replies and link previews
 * @property int|null                                                       $paid_message_star_count Optional. The number of Telegram Stars a general user has to pay to send a message to the chat
 * @property \Telegram\Parts\User|null                                      $guard_bot Optional. The bot that processes join request queries in the chat. The field is only available to chat administrators.
 * @property \Telegram\Parts\Community|null                                 $community Optional. The Community to which the chat belongs
 *
 * @link https://core.telegram.org/bots/api#chatfullinfo
 *
 * @since Bot API 10.3
 */
class ChatFullInfo extends Part
{
    use Concerns\ChatFullInfoBehaviour;

    /** @var list<string> */
    protected array $fillable = [
        'id',
        'type',
        'title',
        'username',
        'first_name',
        'last_name',
        'is_forum',
        'is_direct_messages',
        'accent_color_id',
        'max_reaction_count',
        'photo',
        'active_usernames',
        'birthdate',
        'business_intro',
        'business_location',
        'business_opening_hours',
        'personal_chat',
        'parent_chat',
        'available_reactions',
        'background_custom_emoji_id',
        'profile_accent_color_id',
        'profile_background_custom_emoji_id',
        'emoji_status_custom_emoji_id',
        'emoji_status_expiration_date',
        'bio',
        'has_private_forwards',
        'has_restricted_voice_and_video_messages',
        'join_to_send_messages',
        'join_by_request',
        'description',
        'invite_link',
        'pinned_message',
        'permissions',
        'accepted_gift_types',
        'can_send_paid_media',
        'slow_mode_delay',
        'unrestrict_boost_count',
        'message_auto_delete_time',
        'has_aggressive_anti_spam_enabled',
        'has_hidden_members',
        'has_protected_content',
        'has_visible_history',
        'sticker_set_name',
        'can_set_sticker_set',
        'custom_emoji_sticker_set_name',
        'linked_chat_id',
        'location',
        'rating',
        'first_profile_audio',
        'unique_gift_colors',
        'paid_message_star_count',
        'guard_bot',
        'community',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo'                  => 'ChatPhoto',
        'active_usernames'       => 'Array of String',
        'birthdate'              => 'Birthdate',
        'business_intro'         => 'BusinessIntro',
        'business_location'      => 'BusinessLocation',
        'business_opening_hours' => 'BusinessOpeningHours',
        'personal_chat'          => 'Chat',
        'parent_chat'            => 'Chat',
        'available_reactions'    => 'Array of ReactionType',
        'pinned_message'         => 'Message',
        'permissions'            => 'ChatPermissions',
        'accepted_gift_types'    => 'AcceptedGiftTypes',
        'location'               => 'ChatLocation',
        'rating'                 => 'UserRating',
        'first_profile_audio'    => 'Audio',
        'unique_gift_colors'     => 'UniqueGiftColors',
        'guard_bot'              => 'User',
        'community'              => 'Community',
    ];

    /** @var list<string> */
    protected array $dates = [
        'emoji_status_expiration_date',
    ];
}
