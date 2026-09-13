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
 * This object represents a service message about an edited forum topic.
 *
 * @property string|null $name Optional. New name of the topic, if it was edited
 * @property string|null $icon_custom_emoji_id Optional. New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the icon was removed
 *
 * @link https://core.telegram.org/bots/api#forumtopicedited
 *
 * @since Bot API 10.3
 */
class ForumTopicEdited extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'name',
        'icon_custom_emoji_id',
    ];
}
