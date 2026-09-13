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
 * This object defines the parameters for the creation of a managed bot. Information about the
 * created bot will be shared with the bot using the update managed_bot and a Message with the
 * field managed_bot_created.
 *
 * @property int         $request_id Signed 32-bit identifier of the request. Must be unique within the message.
 * @property string|null $suggested_name Optional. Suggested name for the bot
 * @property string|null $suggested_username Optional. Suggested username for the bot
 *
 * @link https://core.telegram.org/bots/api#keyboardbuttonrequestmanagedbot
 *
 * @since Bot API 10.3
 */
class KeyboardButtonRequestManagedBot extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'request_id',
        'suggested_name',
        'suggested_username',
    ];
}
