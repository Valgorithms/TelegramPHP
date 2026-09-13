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
 * Describes the type of a clickable area on a story. Currently, it can be one of
 * - StoryAreaTypeLocation
 * - StoryAreaTypeSuggestedReaction
 * - StoryAreaTypeLink
 * - StoryAreaTypeWeather
 * - StoryAreaTypeUniqueGift
 *
 * One of: StoryAreaTypeLocation, StoryAreaTypeSuggestedReaction, StoryAreaTypeLink, StoryAreaTypeWeather, StoryAreaTypeUniqueGift.
 *
 * @link https://core.telegram.org/bots/api#storyareatype
 *
 * @since Bot API 10.3
 */
abstract class StoryAreaType extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'location'           => StoryAreaTypeLocation::class,
        'suggested_reaction' => StoryAreaTypeSuggestedReaction::class,
        'link'               => StoryAreaTypeLink::class,
        'weather'            => StoryAreaTypeWeather::class,
        'unique_gift'        => StoryAreaTypeUniqueGift::class,
    ];
}
