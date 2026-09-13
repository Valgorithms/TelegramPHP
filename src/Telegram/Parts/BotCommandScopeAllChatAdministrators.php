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
 * Represents the scope of bot commands, covering all group and supergroup chat administrators.
 *
 * @property string $type Scope type, must be all_chat_administrators
 *
 * @link https://core.telegram.org/bots/api#botcommandscopeallchatadministrators
 *
 * @since Bot API 10.3
 */
class BotCommandScopeAllChatAdministrators extends BotCommandScope
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
