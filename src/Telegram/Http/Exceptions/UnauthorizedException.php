<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http\Exceptions;

/**
 * Thrown on `401 Unauthorized` - the bot token is missing, revoked, or mistyped.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class UnauthorizedException extends HttpException
{
}
