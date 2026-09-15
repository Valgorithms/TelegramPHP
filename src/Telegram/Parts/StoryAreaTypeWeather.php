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
 * Describes a story area containing weather information. Currently, a story can have up to 3
 * weather areas.
 *
 * @property string $type Type of the area, always "weather"
 * @property float  $temperature Temperature, in degree Celsius
 * @property string $emoji Emoji representing the weather
 * @property int    $background_color A color of the area background in the ARGB format
 *
 * @link https://core.telegram.org/bots/api#storyareatypeweather
 *
 * @since v10.3
 */
class StoryAreaTypeWeather extends StoryAreaType
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'temperature',
        'emoji',
        'background_color',
    ];
}
