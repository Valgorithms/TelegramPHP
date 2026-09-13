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
 * Thrown on `403 Forbidden` - the bot was blocked by the user, kicked from the chat, or lacks the right to take the action.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class ForbiddenException extends HttpException
{
}
