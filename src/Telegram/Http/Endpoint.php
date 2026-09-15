<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * Every Bot API method name, as a constant.
 *
 * The Bot API is flat - a call is a `POST` to `/bot<token>/<method>` with a JSON
 * body - so an endpoint is just the method name. Use these where a method name is
 * passed around ({@see Http::execute()}) to keep typos out of the call site.
 *
 * @link https://core.telegram.org/bots/api#available-methods
 *
 * @since v10.3
 */
final class Endpoint
{
    public const ADD_STICKER_TO_SET                     = 'addStickerToSet';
    public const ANSWER_CALLBACK_QUERY                  = 'answerCallbackQuery';
    public const ANSWER_CHAT_JOIN_REQUEST_QUERY         = 'answerChatJoinRequestQuery';
    public const ANSWER_GUEST_QUERY                     = 'answerGuestQuery';
    public const ANSWER_INLINE_QUERY                    = 'answerInlineQuery';
    public const ANSWER_PRE_CHECKOUT_QUERY              = 'answerPreCheckoutQuery';
    public const ANSWER_SHIPPING_QUERY                  = 'answerShippingQuery';
    public const ANSWER_WEB_APP_QUERY                   = 'answerWebAppQuery';
    public const APPROVE_CHAT_JOIN_REQUEST              = 'approveChatJoinRequest';
    public const APPROVE_SUGGESTED_POST                 = 'approveSuggestedPost';
    public const BAN_CHAT_MEMBER                        = 'banChatMember';
    public const BAN_CHAT_SENDER_CHAT                   = 'banChatSenderChat';
    public const CLOSE                                  = 'close';
    public const CLOSE_FORUM_TOPIC                      = 'closeForumTopic';
    public const CLOSE_GENERAL_FORUM_TOPIC              = 'closeGeneralForumTopic';
    public const CONVERT_GIFT_TO_STARS                  = 'convertGiftToStars';
    public const COPY_MESSAGE                           = 'copyMessage';
    public const COPY_MESSAGES                          = 'copyMessages';
    public const CREATE_CHAT_INVITE_LINK                = 'createChatInviteLink';
    public const CREATE_CHAT_SUBSCRIPTION_INVITE_LINK   = 'createChatSubscriptionInviteLink';
    public const CREATE_FORUM_TOPIC                     = 'createForumTopic';
    public const CREATE_INVOICE_LINK                    = 'createInvoiceLink';
    public const CREATE_NEW_STICKER_SET                 = 'createNewStickerSet';
    public const DECLINE_CHAT_JOIN_REQUEST              = 'declineChatJoinRequest';
    public const DECLINE_SUGGESTED_POST                 = 'declineSuggestedPost';
    public const DELETE_ALL_MESSAGE_REACTIONS           = 'deleteAllMessageReactions';
    public const DELETE_BUSINESS_MESSAGES               = 'deleteBusinessMessages';
    public const DELETE_CHAT_PHOTO                      = 'deleteChatPhoto';
    public const DELETE_CHAT_STICKER_SET                = 'deleteChatStickerSet';
    public const DELETE_EPHEMERAL_MESSAGE               = 'deleteEphemeralMessage';
    public const DELETE_FORUM_TOPIC                     = 'deleteForumTopic';
    public const DELETE_MESSAGE                         = 'deleteMessage';
    public const DELETE_MESSAGE_REACTION                = 'deleteMessageReaction';
    public const DELETE_MESSAGES                        = 'deleteMessages';
    public const DELETE_MY_COMMANDS                     = 'deleteMyCommands';
    public const DELETE_STICKER_FROM_SET                = 'deleteStickerFromSet';
    public const DELETE_STICKER_SET                     = 'deleteStickerSet';
    public const DELETE_STORY                           = 'deleteStory';
    public const DELETE_WEBHOOK                         = 'deleteWebhook';
    public const EDIT_CHAT_INVITE_LINK                  = 'editChatInviteLink';
    public const EDIT_CHAT_SUBSCRIPTION_INVITE_LINK     = 'editChatSubscriptionInviteLink';
    public const EDIT_EPHEMERAL_MESSAGE_CAPTION         = 'editEphemeralMessageCaption';
    public const EDIT_EPHEMERAL_MESSAGE_MEDIA           = 'editEphemeralMessageMedia';
    public const EDIT_EPHEMERAL_MESSAGE_REPLY_MARKUP    = 'editEphemeralMessageReplyMarkup';
    public const EDIT_EPHEMERAL_MESSAGE_TEXT            = 'editEphemeralMessageText';
    public const EDIT_FORUM_TOPIC                       = 'editForumTopic';
    public const EDIT_GENERAL_FORUM_TOPIC               = 'editGeneralForumTopic';
    public const EDIT_MESSAGE_CAPTION                   = 'editMessageCaption';
    public const EDIT_MESSAGE_CHECKLIST                 = 'editMessageChecklist';
    public const EDIT_MESSAGE_LIVE_LOCATION             = 'editMessageLiveLocation';
    public const EDIT_MESSAGE_MEDIA                     = 'editMessageMedia';
    public const EDIT_MESSAGE_REPLY_MARKUP              = 'editMessageReplyMarkup';
    public const EDIT_MESSAGE_TEXT                      = 'editMessageText';
    public const EDIT_STORY                             = 'editStory';
    public const EDIT_USER_STAR_SUBSCRIPTION            = 'editUserStarSubscription';
    public const EXPORT_CHAT_INVITE_LINK                = 'exportChatInviteLink';
    public const FORWARD_MESSAGE                        = 'forwardMessage';
    public const FORWARD_MESSAGES                       = 'forwardMessages';
    public const GET_AVAILABLE_GIFTS                    = 'getAvailableGifts';
    public const GET_BUSINESS_ACCOUNT_GIFTS             = 'getBusinessAccountGifts';
    public const GET_BUSINESS_ACCOUNT_STAR_BALANCE      = 'getBusinessAccountStarBalance';
    public const GET_BUSINESS_CONNECTION                = 'getBusinessConnection';
    public const GET_CHAT                               = 'getChat';
    public const GET_CHAT_ADMINISTRATORS                = 'getChatAdministrators';
    public const GET_CHAT_GIFTS                         = 'getChatGifts';
    public const GET_CHAT_MEMBER                        = 'getChatMember';
    public const GET_CHAT_MEMBER_COUNT                  = 'getChatMemberCount';
    public const GET_CHAT_MENU_BUTTON                   = 'getChatMenuButton';
    public const GET_CUSTOM_EMOJI_STICKERS              = 'getCustomEmojiStickers';
    public const GET_FILE                               = 'getFile';
    public const GET_FORUM_TOPIC_ICON_STICKERS          = 'getForumTopicIconStickers';
    public const GET_GAME_HIGH_SCORES                   = 'getGameHighScores';
    public const GET_MANAGED_BOT_ACCESS_SETTINGS        = 'getManagedBotAccessSettings';
    public const GET_MANAGED_BOT_TOKEN                  = 'getManagedBotToken';
    public const GET_ME                                 = 'getMe';
    public const GET_MY_COMMANDS                        = 'getMyCommands';
    public const GET_MY_DEFAULT_ADMINISTRATOR_RIGHTS    = 'getMyDefaultAdministratorRights';
    public const GET_MY_DESCRIPTION                     = 'getMyDescription';
    public const GET_MY_NAME                            = 'getMyName';
    public const GET_MY_SHORT_DESCRIPTION               = 'getMyShortDescription';
    public const GET_MY_STAR_BALANCE                    = 'getMyStarBalance';
    public const GET_STAR_TRANSACTIONS                  = 'getStarTransactions';
    public const GET_STICKER_SET                        = 'getStickerSet';
    public const GET_UPDATES                            = 'getUpdates';
    public const GET_USER_CHAT_BOOSTS                   = 'getUserChatBoosts';
    public const GET_USER_GIFTS                         = 'getUserGifts';
    public const GET_USER_PERSONAL_CHAT_MESSAGES        = 'getUserPersonalChatMessages';
    public const GET_USER_PROFILE_AUDIOS                = 'getUserProfileAudios';
    public const GET_USER_PROFILE_PHOTOS                = 'getUserProfilePhotos';
    public const GET_WEBHOOK_INFO                       = 'getWebhookInfo';
    public const GIFT_PREMIUM_SUBSCRIPTION              = 'giftPremiumSubscription';
    public const HIDE_GENERAL_FORUM_TOPIC               = 'hideGeneralForumTopic';
    public const LEAVE_CHAT                             = 'leaveChat';
    public const LOG_OUT                                = 'logOut';
    public const PIN_CHAT_MESSAGE                       = 'pinChatMessage';
    public const POST_STORY                             = 'postStory';
    public const PROMOTE_CHAT_MEMBER                    = 'promoteChatMember';
    public const READ_BUSINESS_MESSAGE                  = 'readBusinessMessage';
    public const REFUND_STAR_PAYMENT                    = 'refundStarPayment';
    public const REMOVE_BUSINESS_ACCOUNT_PROFILE_PHOTO  = 'removeBusinessAccountProfilePhoto';
    public const REMOVE_CHAT_VERIFICATION               = 'removeChatVerification';
    public const REMOVE_MY_PROFILE_PHOTO                = 'removeMyProfilePhoto';
    public const REMOVE_USER_VERIFICATION               = 'removeUserVerification';
    public const REOPEN_FORUM_TOPIC                     = 'reopenForumTopic';
    public const REOPEN_GENERAL_FORUM_TOPIC             = 'reopenGeneralForumTopic';
    public const REPLACE_MANAGED_BOT_TOKEN              = 'replaceManagedBotToken';
    public const REPLACE_STICKER_IN_SET                 = 'replaceStickerInSet';
    public const REPOST_STORY                           = 'repostStory';
    public const RESTRICT_CHAT_MEMBER                   = 'restrictChatMember';
    public const REVOKE_CHAT_INVITE_LINK                = 'revokeChatInviteLink';
    public const SAVE_PREPARED_INLINE_MESSAGE           = 'savePreparedInlineMessage';
    public const SAVE_PREPARED_KEYBOARD_BUTTON          = 'savePreparedKeyboardButton';
    public const SEND_ANIMATION                         = 'sendAnimation';
    public const SEND_AUDIO                             = 'sendAudio';
    public const SEND_CHAT_ACTION                       = 'sendChatAction';
    public const SEND_CHAT_JOIN_REQUEST_WEB_APP         = 'sendChatJoinRequestWebApp';
    public const SEND_CHECKLIST                         = 'sendChecklist';
    public const SEND_CONTACT                           = 'sendContact';
    public const SEND_DICE                              = 'sendDice';
    public const SEND_DOCUMENT                          = 'sendDocument';
    public const SEND_GAME                              = 'sendGame';
    public const SEND_GIFT                              = 'sendGift';
    public const SEND_INVOICE                           = 'sendInvoice';
    public const SEND_LIVE_PHOTO                        = 'sendLivePhoto';
    public const SEND_LOCATION                          = 'sendLocation';
    public const SEND_MEDIA_GROUP                       = 'sendMediaGroup';
    public const SEND_MESSAGE                           = 'sendMessage';
    public const SEND_MESSAGE_DRAFT                     = 'sendMessageDraft';
    public const SEND_PAID_MEDIA                        = 'sendPaidMedia';
    public const SEND_PHOTO                             = 'sendPhoto';
    public const SEND_POLL                              = 'sendPoll';
    public const SEND_RICH_MESSAGE                      = 'sendRichMessage';
    public const SEND_RICH_MESSAGE_DRAFT                = 'sendRichMessageDraft';
    public const SEND_STICKER                           = 'sendSticker';
    public const SEND_VENUE                             = 'sendVenue';
    public const SEND_VIDEO                             = 'sendVideo';
    public const SEND_VIDEO_NOTE                        = 'sendVideoNote';
    public const SEND_VOICE                             = 'sendVoice';
    public const SET_BUSINESS_ACCOUNT_BIO               = 'setBusinessAccountBio';
    public const SET_BUSINESS_ACCOUNT_GIFT_SETTINGS     = 'setBusinessAccountGiftSettings';
    public const SET_BUSINESS_ACCOUNT_NAME              = 'setBusinessAccountName';
    public const SET_BUSINESS_ACCOUNT_PROFILE_PHOTO     = 'setBusinessAccountProfilePhoto';
    public const SET_BUSINESS_ACCOUNT_USERNAME          = 'setBusinessAccountUsername';
    public const SET_CHAT_ADMINISTRATOR_CUSTOM_TITLE    = 'setChatAdministratorCustomTitle';
    public const SET_CHAT_DESCRIPTION                   = 'setChatDescription';
    public const SET_CHAT_MEMBER_TAG                    = 'setChatMemberTag';
    public const SET_CHAT_MENU_BUTTON                   = 'setChatMenuButton';
    public const SET_CHAT_PERMISSIONS                   = 'setChatPermissions';
    public const SET_CHAT_PHOTO                         = 'setChatPhoto';
    public const SET_CHAT_STICKER_SET                   = 'setChatStickerSet';
    public const SET_CHAT_TITLE                         = 'setChatTitle';
    public const SET_CUSTOM_EMOJI_STICKER_SET_THUMBNAIL = 'setCustomEmojiStickerSetThumbnail';
    public const SET_GAME_SCORE                         = 'setGameScore';
    public const SET_MANAGED_BOT_ACCESS_SETTINGS        = 'setManagedBotAccessSettings';
    public const SET_MESSAGE_REACTION                   = 'setMessageReaction';
    public const SET_MY_COMMANDS                        = 'setMyCommands';
    public const SET_MY_DEFAULT_ADMINISTRATOR_RIGHTS    = 'setMyDefaultAdministratorRights';
    public const SET_MY_DESCRIPTION                     = 'setMyDescription';
    public const SET_MY_NAME                            = 'setMyName';
    public const SET_MY_PROFILE_PHOTO                   = 'setMyProfilePhoto';
    public const SET_MY_SHORT_DESCRIPTION               = 'setMyShortDescription';
    public const SET_PASSPORT_DATA_ERRORS               = 'setPassportDataErrors';
    public const SET_STICKER_EMOJI_LIST                 = 'setStickerEmojiList';
    public const SET_STICKER_KEYWORDS                   = 'setStickerKeywords';
    public const SET_STICKER_MASK_POSITION              = 'setStickerMaskPosition';
    public const SET_STICKER_POSITION_IN_SET            = 'setStickerPositionInSet';
    public const SET_STICKER_SET_THUMBNAIL              = 'setStickerSetThumbnail';
    public const SET_STICKER_SET_TITLE                  = 'setStickerSetTitle';
    public const SET_USER_EMOJI_STATUS                  = 'setUserEmojiStatus';
    public const SET_WEBHOOK                            = 'setWebhook';
    public const STOP_MESSAGE_LIVE_LOCATION             = 'stopMessageLiveLocation';
    public const STOP_POLL                              = 'stopPoll';
    public const TRANSFER_BUSINESS_ACCOUNT_STARS        = 'transferBusinessAccountStars';
    public const TRANSFER_GIFT                          = 'transferGift';
    public const UNBAN_CHAT_MEMBER                      = 'unbanChatMember';
    public const UNBAN_CHAT_SENDER_CHAT                 = 'unbanChatSenderChat';
    public const UNHIDE_GENERAL_FORUM_TOPIC             = 'unhideGeneralForumTopic';
    public const UNPIN_ALL_CHAT_MESSAGES                = 'unpinAllChatMessages';
    public const UNPIN_ALL_FORUM_TOPIC_MESSAGES         = 'unpinAllForumTopicMessages';
    public const UNPIN_ALL_GENERAL_FORUM_TOPIC_MESSAGES = 'unpinAllGeneralForumTopicMessages';
    public const UNPIN_CHAT_MESSAGE                     = 'unpinChatMessage';
    public const UPGRADE_GIFT                           = 'upgradeGift';
    public const UPLOAD_STICKER_FILE                    = 'uploadStickerFile';
    public const VERIFY_CHAT                            = 'verifyChat';
    public const VERIFY_USER                            = 'verifyUser';

    /** @return list<string> Every Bot API method this build knows about. */
    public static function all(): array
    {
        return array_values((new \ReflectionClass(self::class))->getConstants());
    }
}
