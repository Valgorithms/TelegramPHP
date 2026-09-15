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
 * Describes a rich message to be sent. Exactly one of the fields html, markdown, or blocks must be
 * used.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\InputRichBlock>|null        $blocks Optional. Content of the rich message to send described as a list of blocks
 * @property string|null                                                             $html Optional. Content of the rich message to send described using HTML formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.
 * @property string|null                                                             $markdown Optional. Content of the rich message to send described using Markdown formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\InputRichMessageMedia>|null $media Optional. List of media that are specified in the markdown or html fields using tg://photo?id=, tg://video?id=, tg://document?id=, and tg://audio?id= links
 * @property bool|null                                                               $is_rtl Optional. Pass True if the rich message must be shown right-to-left
 * @property bool|null                                                               $skip_entity_detection Optional. Pass True to skip automatic detection of entities (e.g., URLs, email addresses, username mentions, hashtags, cashtags, bot commands, or phone numbers) in the text
 *
 * @link https://core.telegram.org/bots/api#inputrichmessage
 *
 * @since v10.3
 */
class InputRichMessage extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'blocks',
        'html',
        'markdown',
        'media',
        'is_rtl',
        'skip_entity_detection',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'blocks' => 'Array of InputRichBlock',
        'media'  => 'Array of InputRichMessageMedia',
    ];
}
