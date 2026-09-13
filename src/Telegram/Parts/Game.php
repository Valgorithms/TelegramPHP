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
 * This object represents a game. Use BotFather to create and edit games, their short names will
 * act as unique identifiers.
 *
 * @property string                                                          $title Title of the game
 * @property string                                                          $description Description of the game
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PhotoSize>          $photo Photo that will be displayed in the game message in chats
 * @property string|null                                                     $text Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $text_entities Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
 * @property \Telegram\Parts\Animation|null                                  $animation Optional. Animation that will be displayed in the game message in chats. Upload via BotFather.
 *
 * @link https://core.telegram.org/bots/api#game
 *
 * @since Bot API 10.3
 */
class Game extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'title',
        'description',
        'photo',
        'text',
        'text_entities',
        'animation',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'photo'         => 'Array of PhotoSize',
        'text_entities' => 'Array of MessageEntity',
        'animation'     => 'Animation',
    ];
}
