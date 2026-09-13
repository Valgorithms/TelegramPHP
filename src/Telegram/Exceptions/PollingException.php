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
 * Long polling or the webhook listener could not be started, or stopped for a
 * reason the client cannot recover from on its own.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class PollingException extends TelegramException
{
}
