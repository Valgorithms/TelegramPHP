<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts\Concerns;

/**
 * The full chat record does everything the stub does - `getChat` hands back a
 * {@see \Telegram\Parts\ChatFullInfo}, and it would be odd if that could do less
 * than the {@see \Telegram\Parts\Chat} an update arrived with.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait ChatFullInfoBehaviour
{
    use ChatBehaviour;
}
