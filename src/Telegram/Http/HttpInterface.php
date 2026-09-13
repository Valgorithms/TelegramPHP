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

use React\Promise\PromiseInterface;

/**
 * The contract {@see Http} fulfils. Depend on this rather than the concrete class
 * so the transport can be decorated or faked (test doubles, alternative drivers,
 * a local Bot API server).
 *
 * {@see execute()} resolves with the *unwrapped* `result` member of the Bot API
 * envelope - a scalar, an array, or `true` - and rejects with a
 * {@see Exceptions\HttpException} subclass when `ok` is false.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
interface HttpInterface
{
    /**
     * Calls one Bot API method.
     *
     * @param array<string, mixed> $content Field name => value. Values may be
     *                                      scalars, arrays, {@see \JsonSerializable}
     *                                      objects, or {@see \Telegram\Builders\InputFile}
     *                                      instances, which switch the request to
     *                                      `multipart/form-data`.
     *
     * @return PromiseInterface<mixed>
     */
    public function execute(string $method, array $content = []): PromiseInterface;

    /**
     * Downloads a file previously located with `getFile`, resolving with its bytes.
     *
     * @param string $filePath The `file_path` from a {@see \Telegram\Parts\File}.
     *
     * @return PromiseInterface<string>
     */
    public function download(string $filePath): PromiseInterface;

    /** The absolute URL a `file_path` resolves to, token included. */
    public function fileUrl(string $filePath): string;

    /** Swap in a different bot token; queued requests pick it up. */
    public function setToken(string $token): void;
}
