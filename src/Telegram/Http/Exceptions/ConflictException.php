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
 * Thrown on `409 Conflict` - most often a webhook is active while {@see \Telegram\Api\UpdateApi::getUpdates()} is being polled, or two pollers share one token.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class ConflictException extends HttpException
{
}
