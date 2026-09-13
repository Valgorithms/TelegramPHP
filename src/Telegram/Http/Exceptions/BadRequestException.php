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
 * Thrown on `400 Bad Request` - the call was malformed, or the chat, message, or file it named does not exist. Check {@see HttpException::getMigrateToChatId()}: a group that has been upgraded to a supergroup reports the new id here.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class BadRequestException extends HttpException
{
}
