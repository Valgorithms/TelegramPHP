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
 * Thrown on `404 Not Found` - no such Bot API method. Usually a typo, or a method newer than the Bot API server being called.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class NotFoundException extends HttpException
{
}
