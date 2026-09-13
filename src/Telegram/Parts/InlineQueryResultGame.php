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
 * Represents a Game.
 *
 * @property string                                    $type Type of the result, must be game
 * @property string                                    $id Unique identifier for this result, 1-64 bytes
 * @property string                                    $game_short_name Short name of the game
 * @property \Telegram\Parts\InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 *
 * @since Bot API 10.3
 */
class InlineQueryResultGame extends InlineQueryResult
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'id',
        'game_short_name',
        'reply_markup',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'reply_markup' => 'InlineKeyboardMarkup',
    ];
}
