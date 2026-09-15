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
 * This object represents a service message about a user allowing a bot to write messages after
 * adding it to the attachment menu, launching a Web App from a link, or accepting an explicit
 * request from a Web App sent by the method requestWriteAccess.
 *
 * @property bool|null   $from_request Optional. True, if the access was granted after the user accepted an explicit request from a Web App sent by the method requestWriteAccess
 * @property string|null $web_app_name Optional. Name of the Web App, if the access was granted when the Web App was launched from a link
 * @property bool|null   $from_attachment_menu Optional. True, if the access was granted when the bot was added to the attachment or side menu
 *
 * @link https://core.telegram.org/bots/api#writeaccessallowed
 *
 * @since v10.3
 */
class WriteAccessAllowed extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'from_request',
        'web_app_name',
        'from_attachment_menu',
    ];
}
