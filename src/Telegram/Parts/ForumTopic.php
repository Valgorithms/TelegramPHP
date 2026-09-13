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
 * This object represents a forum topic.
 *
 * @property int         $message_thread_id Unique identifier of the forum topic
 * @property string      $name Name of the topic
 * @property int         $icon_color Color of the topic icon in RGB format
 * @property string|null $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown as the topic icon
 * @property bool|null   $is_name_implicit Optional. True, if the name of the topic wasn't specified explicitly by its creator and likely needs to be changed by the bot
 *
 * @link https://core.telegram.org/bots/api#forumtopic
 *
 * @since Bot API 10.3
 */
class ForumTopic extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'message_thread_id',
        'name',
        'icon_color',
        'icon_custom_emoji_id',
        'is_name_implicit',
    ];
}
