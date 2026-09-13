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
 * Thrown on `429 Too Many Requests` after the client has exhausted its retries. {@see HttpException::getRetryAfter()} carries the cool-off Telegram asked for.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class TooManyRequestsException extends HttpException
{
}
