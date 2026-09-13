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
 * Describes a story area pointing to a suggested reaction. Currently, a story can have up to 5
 * suggested reaction areas.
 *
 * @property string                       $type Type of the area, always "suggested_reaction"
 * @property \Telegram\Parts\ReactionType $reaction_type Type of the reaction
 * @property bool|null                    $is_dark Optional. Pass True if the reaction area has a dark background
 * @property bool|null                    $is_flipped Optional. Pass True if reaction area corner is flipped
 *
 * @link https://core.telegram.org/bots/api#storyareatypesuggestedreaction
 *
 * @since Bot API 10.3
 */
class StoryAreaTypeSuggestedReaction extends StoryAreaType
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'reaction_type',
        'is_dark',
        'is_flipped',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'reaction_type' => 'ReactionType',
    ];
}
