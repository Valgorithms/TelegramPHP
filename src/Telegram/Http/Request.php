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

use React\Promise\Deferred;

/**
 * One prepared Bot API call: the method name, the absolute URL, the encoded body,
 * the headers, and the {@see Deferred} that {@see Http} settles with the unwrapped
 * `result`.
 *
 * The Bot API is a flat RPC surface - every method call is a `POST` to
 * `/bot<token>/<method>` - so a request carries no path of its own beyond the
 * method name. File downloads (`GET /file/bot<token>/<file_path>`) reuse the same
 * object with an explicit verb.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Request
{
    private int $attempts = 0;

    /**
     * @param string                $endpoint The Bot API method name, or the file path for a download.
     * @param array<string, string> $headers
     */
    public function __construct(
        private readonly Deferred $deferred,
        private readonly string $endpoint,
        private readonly string $url,
        private readonly string $content = '',
        private array $headers = [],
        private readonly string $method = 'POST',
    ) {
    }

    /** `POST` for every method call; `GET` for a file download. */
    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    /** The Bot API method name, e.g. `sendMessage`. */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /** The absolute URL, token included. */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /** @return array<string, string> */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    public function getDeferred(): Deferred
    {
        return $this->deferred;
    }

    public function bumpAttempts(): int
    {
        return ++$this->attempts;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function __toString(): string
    {
        return $this->getMethod() . ' ' . $this->endpoint;
    }
}
