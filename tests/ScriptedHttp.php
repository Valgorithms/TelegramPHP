<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Tests;

use React\Promise\PromiseInterface;

use function React\Promise\reject;
use function React\Promise\resolve;

use Telegram\Http\HttpInterface;

/**
 * A stand-in {@see HttpInterface} that records every call and replays a scripted
 * list of results. Nothing here touches the network, so the tests can drive all
 * 185 Bot API methods without a token.
 */
final class ScriptedHttp implements HttpInterface
{
    /** @var list<array{0: string, 1: array<string, mixed>}> Method name and payload, in order. */
    public array $calls = [];

    /** @var list<mixed> Results handed back, one per call, before {@see $default}. */
    public array $script = [];

    /** What every unscripted call resolves with. */
    public mixed $default = true;

    /** When set, the next call rejects with this instead of resolving. */
    public ?\Throwable $throw = null;

    /** What {@see download()} resolves with. */
    public string $fileContents = 'file-bytes';

    public string $token = 'TEST:TOKEN';

    public function execute(string $method, array $content = []): PromiseInterface
    {
        $this->calls[] = [$method, $content];

        if ($this->throw !== null) {
            $error = $this->throw;
            $this->throw = null;

            return reject($error);
        }

        return resolve($this->script === [] ? $this->default : array_shift($this->script));
    }

    public function download(string $filePath): PromiseInterface
    {
        $this->calls[] = ['@download', ['file_path' => $filePath]];

        return resolve($this->fileContents);
    }

    public function fileUrl(string $filePath): string
    {
        return 'https://api.telegram.org/file/bot' . $this->token . '/' . ltrim($filePath, '/');
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /** The most recent call, or null when nothing has been called. */
    public function lastCall(): ?array
    {
        return $this->calls === [] ? null : $this->calls[array_key_last($this->calls)];
    }

    /** The payload of the most recent call. */
    public function lastPayload(): array
    {
        return $this->lastCall()[1] ?? [];
    }

    /** The method name of the most recent call. */
    public function lastMethod(): ?string
    {
        return $this->lastCall()[0] ?? null;
    }

    public function reset(): void
    {
        $this->calls = [];
        $this->script = [];
        $this->throw = null;
    }
}
