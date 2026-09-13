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
 * Describes a story area pointing to a unique gift. Currently, a story can have at most 1 unique
 * gift area.
 *
 * @property string $type Type of the area, always "unique_gift"
 * @property string $name Unique name of the gift
 *
 * @link https://core.telegram.org/bots/api#storyareatypeuniquegift
 *
 * @since Bot API 10.3
 */
class StoryAreaTypeUniqueGift extends StoryAreaType
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'name',
    ];
}
