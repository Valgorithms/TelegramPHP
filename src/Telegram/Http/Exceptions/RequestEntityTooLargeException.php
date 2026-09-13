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
 * Thrown on `413 Request Entity Too Large` - the uploaded file exceeds the Bot API limit (50 MB for most media on the official server).
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class RequestEntityTooLargeException extends HttpException
{
}
