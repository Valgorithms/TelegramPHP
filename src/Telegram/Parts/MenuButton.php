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
 * This object describes the bot's menu button in a private chat. It should be one of
 * - MenuButtonCommands
 * - MenuButtonWebApp
 * - MenuButtonDefault
 * If a menu button other than MenuButtonDefault is set for a private chat, then it is applied in
 * the chat. Otherwise the default menu button is applied. By default, the menu button opens the
 * list of bot commands.
 *
 * One of: MenuButtonCommands, MenuButtonWebApp, MenuButtonDefault.
 *
 * @link https://core.telegram.org/bots/api#menubutton
 *
 * @since v10.3
 */
abstract class MenuButton extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'commands' => MenuButtonCommands::class,
        'web_app'  => MenuButtonWebApp::class,
        'default'  => MenuButtonDefault::class,
    ];
}
