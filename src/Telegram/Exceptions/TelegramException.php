<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Exceptions;

/**
 * Base for errors raised by TelegramPHP itself, as opposed to errors reported by
 * Telegram - those arrive as {@see \Telegram\Http\Exceptions\HttpException}.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class TelegramException extends \RuntimeException
{
}
