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
 * Describes a media element embedded in an outgoing rich message.
 *
 * @property string                                                                                                                                                                                                     $id Unique identifier of the media used in a tg://photo?id=, tg://video?id=, tg://document?id=, or tg://audio?id= link. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.
 * @property \Telegram\Parts\InputMediaAnimation|\Telegram\Parts\InputMediaAudio|\Telegram\Parts\InputMediaDocument|\Telegram\Parts\InputMediaPhoto|\Telegram\Parts\InputMediaVideo|\Telegram\Parts\InputMediaVoiceNote $media The media to be sent. Everything except the media itself and its properties is ignored.
 *
 * @link https://core.telegram.org/bots/api#inputrichmessagemedia
 *
 * @since v10.3
 */
class InputRichMessageMedia extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'id',
        'media',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'media' => 'InputMediaAnimation',
    ];
}
