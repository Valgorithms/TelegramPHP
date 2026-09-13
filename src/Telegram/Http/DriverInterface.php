<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http;

use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;

/**
 * Executes a single prepared {@see Request} and resolves with the raw
 * {@see ResponseInterface} - success or error status alike. Retries, the
 * `retry_after` hold-off, envelope unwrapping, and exception mapping are
 * {@see Http}'s job, not the driver's.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
interface DriverInterface
{
    /**
     * @return PromiseInterface<ResponseInterface>
     */
    public function runRequest(Request $request): PromiseInterface;
}
