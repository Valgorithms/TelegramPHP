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
 * Represents the default scope of bot commands. Default commands are used if no commands with a
 * narrower scope are specified for the user.
 *
 * @property string $type Scope type, must be default
 *
 * @link https://core.telegram.org/bots/api#botcommandscopedefault
 *
 * @since Bot API 10.3
 */
class BotCommandScopeDefault extends BotCommandScope
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
    ];
}
