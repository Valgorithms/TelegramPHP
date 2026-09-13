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
 * This object represents a parameter of the inline keyboard button used to automatically authorize
 * a user. It serves as a great replacement for the Telegram Login Widget when the user is coming
 * from Telegram. All the user needs to do is tap/click a button and confirm that they want to log
 * in:
 *
 * @property string      $url An HTTPS URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data. NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
 * @property string|null $forward_text Optional. New text of the button in forwarded messages
 * @property string|null $bot_username Optional. Username of a bot, which will be used for user authorization; not supported in RichMessageButton. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
 * @property bool|null   $request_write_access Optional. Pass True to request the permission for your bot to send messages to the user
 *
 * @link https://core.telegram.org/bots/api#loginurl
 *
 * @since Bot API 10.3
 */
class LoginUrl extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'url',
        'forward_text',
        'bot_username',
        'request_write_access',
    ];
}
