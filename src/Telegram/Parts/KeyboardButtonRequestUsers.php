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
 * This object defines the criteria used to request suitable users. Information about the selected
 * users will be shared with the bot when the corresponding button is pressed. More about
 * requesting users: https://core.telegram.org/bots/features#chat-and-user-selection
 *
 * @property int       $request_id Signed 32-bit identifier of the request that will be received back in the UsersShared object. Must be unique within the message.
 * @property bool|null $user_is_bot Optional. Pass True to request bots, pass False to request regular users. If not specified, no additional restrictions are applied.
 * @property bool|null $user_is_premium Optional. Pass True to request premium users, pass False to request non-premium users. If not specified, no additional restrictions are applied.
 * @property int|null  $max_quantity Optional. The maximum number of users to be selected; 1-10. Defaults to 1.
 * @property bool|null $request_name Optional. Pass True to request the users' first and last names
 * @property bool|null $request_username Optional. Pass True to request the users' usernames
 * @property bool|null $request_photo Optional. Pass True to request the users' photos
 *
 * @link https://core.telegram.org/bots/api#keyboardbuttonrequestusers
 *
 * @since v10.3
 */
class KeyboardButtonRequestUsers extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'request_id',
        'user_is_bot',
        'user_is_premium',
        'max_quantity',
        'request_name',
        'request_username',
        'request_photo',
    ];
}
