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
 * Describes a Web App.
 *
 * @property string $url An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
 *
 * @link https://core.telegram.org/bots/api#webappinfo
 *
 * @since Bot API 10.3
 */
class WebAppInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'url',
    ];
}
