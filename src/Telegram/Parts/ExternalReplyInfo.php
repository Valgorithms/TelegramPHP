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
 * This object contains information about a message that is being replied to, which may come from
 * another chat or forum topic.
 *
 * @property \Telegram\Parts\MessageOrigin                               $origin Origin of the message replied to by the given message
 * @property \Telegram\Parts\Chat|null                                   $chat Optional. Chat the original message belongs to. Available only if the chat is a supergroup or a channel.
 * @property int|null                                                    $message_id Optional. Unique message identifier inside the original chat. Available only if the original chat is a supergroup or a channel.
 * @property \Telegram\Parts\LinkPreviewOptions|null                     $link_preview_options Optional. Options used for link preview generation for the original message, if it is a text message
 * @property \Telegram\Parts\Animation|null                              $animation Optional. Message is an animation, information about the animation
 * @property \Telegram\Parts\Audio|null                                  $audio Optional. Message is an audio file, information about the file
 * @property \Telegram\Parts\Document|null                               $document Optional. Message is a general file, information about the file
 * @property \Telegram\Parts\LivePhoto|null                              $live_photo Optional. Message is a live photo, information about the live photo
 * @property \Telegram\Parts\PaidMediaInfo|null                          $paid_media Optional. Message contains paid media; information about the paid media
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>|null $photo Optional. Message is a photo, available sizes of the photo
 * @property \Telegram\Parts\Sticker|null                                $sticker Optional. Message is a sticker, information about the sticker
 * @property \Telegram\Parts\Story|null                                  $story Optional. Message is a forwarded story
 * @property \Telegram\Parts\Video|null                                  $video Optional. Message is a video, information about the video
 * @property \Telegram\Parts\VideoNote|null                              $video_note Optional. Message is a video note, information about the video message
 * @property \Telegram\Parts\Voice|null                                  $voice Optional. Message is a voice message, information about the file
 * @property bool|null                                                   $has_media_spoiler Optional. True, if the message media is covered by a spoiler animation
 * @property \Telegram\Parts\Checklist|null                              $checklist Optional. Message is a checklist
 * @property \Telegram\Parts\Contact|null                                $contact Optional. Message is a shared contact, information about the contact
 * @property \Telegram\Parts\Dice|null                                   $dice Optional. Message is a dice with random value
 * @property \Telegram\Parts\Game|null                                   $game Optional. Message is a game, information about the game. More about games: https://core.telegram.org/bots/api#games
 * @property \Telegram\Parts\Giveaway|null                               $giveaway Optional. Message is a scheduled giveaway, information about the giveaway
 * @property \Telegram\Parts\GiveawayWinners|null                        $giveaway_winners Optional. A giveaway with public winners was completed
 * @property \Telegram\Parts\Invoice|null                                $invoice Optional. Message is an invoice for a payment, information about the invoice. More about payments: https://core.telegram.org/bots/api#payments
 * @property \Telegram\Parts\Location|null                               $location Optional. Message is a shared location, information about the location
 * @property \Telegram\Parts\Poll|null                                   $poll Optional. Message is a native poll, information about the poll
 * @property \Telegram\Parts\Venue|null                                  $venue Optional. Message is a venue, information about the venue
 *
 * @link https://core.telegram.org/bots/api#externalreplyinfo
 *
 * @since v10.3
 */
class ExternalReplyInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'origin',
        'chat',
        'message_id',
        'link_preview_options',
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
        'has_media_spoiler',
        'checklist',
        'contact',
        'dice',
        'game',
        'giveaway',
        'giveaway_winners',
        'invoice',
        'location',
        'poll',
        'venue',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'origin'               => 'MessageOrigin',
        'chat'                 => 'Chat',
        'link_preview_options' => 'LinkPreviewOptions',
        'animation'            => 'Animation',
        'audio'                => 'Audio',
        'document'             => 'Document',
        'live_photo'           => 'LivePhoto',
        'paid_media'           => 'PaidMediaInfo',
        'photo'                => 'Array of PhotoSize',
        'sticker'              => 'Sticker',
        'story'                => 'Story',
        'video'                => 'Video',
        'video_note'           => 'VideoNote',
        'voice'                => 'Voice',
        'checklist'            => 'Checklist',
        'contact'              => 'Contact',
        'dice'                 => 'Dice',
        'game'                 => 'Game',
        'giveaway'             => 'Giveaway',
        'giveaway_winners'     => 'GiveawayWinners',
        'invoice'              => 'Invoice',
        'location'             => 'Location',
        'poll'                 => 'Poll',
        'venue'                => 'Venue',
    ];
}
