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
 * This object contains information about a poll.
 *
 * @property string                                                          $id Unique poll identifier
 * @property string                                                          $question Poll question, 1-300 characters
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $question_entities Optional. Special entities that appear in the question. Currently, only custom emoji entities are allowed in poll questions
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PollOption>         $options List of poll options
 * @property int                                                             $total_voter_count Total number of users that voted in the poll
 * @property bool                                                            $is_closed True, if the poll is closed
 * @property bool                                                            $is_anonymous True, if the poll is anonymous
 * @property string                                                          $type Poll type, currently can be "regular" or "quiz"
 * @property bool                                                            $allows_multiple_answers True, if the poll allows multiple answers
 * @property bool                                                            $allows_revoting True, if the poll allows to change the chosen answer options
 * @property bool                                                            $members_only True if voting is limited to users who have been members of the chat where the poll was originally sent for more than 24 hours
 * @property array<int, string>|null                                         $country_codes Optional. A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which users can vote in the poll. The country code "FT" is used for users with anonymous numbers. If omitted, then users from any country can participate in the poll.
 * @property array<int, int>|null                                            $correct_option_ids Optional. Array of 0-based identifiers of the correct answer options. Available only for polls in quiz mode which are closed or were sent (not forwarded) by the bot or to the private chat with the bot.
 * @property string|null                                                     $explanation Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $explanation_entities Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
 * @property \Telegram\Parts\PollMedia|null                                  $explanation_media Optional. Media added to the quiz explanation
 * @property int|null                                                        $open_period Optional. Amount of time in seconds the poll will be active after creation
 * @property \Carbon\CarbonImmutable|null                                    $close_date Optional. Point in time (Unix timestamp) when the poll will be automatically closed
 * @property string|null                                                     $description Optional. Description of the poll; for polls inside the Message object only
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $description_entities Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the description
 * @property \Telegram\Parts\PollMedia|null                                  $media Optional. Media added to the poll description; for polls inside the Message object only
 *
 * @link https://core.telegram.org/bots/api#poll
 *
 * @since v10.3
 */
class Poll extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'question',
        'question_entities',
        'options',
        'total_voter_count',
        'is_closed',
        'is_anonymous',
        'type',
        'allows_multiple_answers',
        'allows_revoting',
        'members_only',
        'country_codes',
        'correct_option_ids',
        'explanation',
        'explanation_entities',
        'explanation_media',
        'open_period',
        'close_date',
        'description',
        'description_entities',
        'media',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'question_entities'    => 'Array of MessageEntity',
        'options'              => 'Array of PollOption',
        'country_codes'        => 'Array of String',
        'correct_option_ids'   => 'Array of Integer',
        'explanation_entities' => 'Array of MessageEntity',
        'explanation_media'    => 'PollMedia',
        'description_entities' => 'Array of MessageEntity',
        'media'                => 'PollMedia',
    ];

    /** @var list<string> */
    protected array $dates = [
        'close_date',
    ];
}
