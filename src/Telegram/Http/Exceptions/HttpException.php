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

use Psr\Http\Message\ResponseInterface;

/**
 * Base for every failed Bot API call.
 *
 * Telegram answers errors with `{"ok": false, "error_code": 400, "description":
 * "Bad Request: chat not found"}` and, for a few conditions, a `parameters`
 * object carrying `retry_after` or `migrate_to_chat_id`. All of that is lifted
 * onto the exception, so callers can branch on {@see getErrorCode()} and
 * {@see getRetryAfter()} without re-parsing the body.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class HttpException extends \RuntimeException
{
    /**
     * @param array<string, mixed> $parameters The `parameters` object from the error envelope.
     */
    public function __construct(
        string $message,
        private readonly int $errorCode = 0,
        private readonly ?ResponseInterface $response = null,
        private readonly array $parameters = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $errorCode, $previous);
    }

    /**
     * Builds the most specific exception class for a Bot API error response.
     *
     * @param array<string, mixed>|null $decoded The decoded body, when it parsed as JSON.
     */
    public static function fromResponse(ResponseInterface $response, ?array $decoded = null): self
    {
        $status = $response->getStatusCode();
        $errorCode = (int) ($decoded['error_code'] ?? $status);
        $description = (string) ($decoded['description'] ?? $response->getReasonPhrase());
        $parameters = is_array($decoded['parameters'] ?? null) ? $decoded['parameters'] : [];

        $class = match (true) {
            $errorCode === 400 => BadRequestException::class,
            $errorCode === 401 => UnauthorizedException::class,
            $errorCode === 403 => ForbiddenException::class,
            $errorCode === 404 => NotFoundException::class,
            $errorCode === 409 => ConflictException::class,
            $errorCode === 413 => RequestEntityTooLargeException::class,
            $errorCode === 429 => TooManyRequestsException::class,
            $errorCode >= 500 => ServerException::class,
            default => self::class,
        };

        return new $class($description, $errorCode, $response, $parameters);
    }

    /** The Bot API `error_code`, which mirrors the HTTP status. */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /** The raw response, when the failure came back over HTTP at all. */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * The `parameters` object from the error envelope.
     *
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /** Seconds to wait before repeating the request, when Telegram said so. */
    public function getRetryAfter(): ?int
    {
        return isset($this->parameters['retry_after']) ? (int) $this->parameters['retry_after'] : null;
    }

    /**
     * The supergroup the request should be retried against, set when a group
     * chat has been upgraded and the old `chat_id` no longer resolves.
     */
    public function getMigrateToChatId(): ?int
    {
        return isset($this->parameters['migrate_to_chat_id']) ? (int) $this->parameters['migrate_to_chat_id'] : null;
    }
}
