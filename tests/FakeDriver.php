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

use Psr\Http\Message\ResponseInterface;
use React\Http\Message\Response;
use React\Promise\PromiseInterface;

use function React\Promise\reject;
use function React\Promise\resolve;

use Telegram\Http\DriverInterface;
use Telegram\Http\Request;

/**
 * A {@see DriverInterface} that answers from a queue of canned responses instead
 * of the network, so {@see \Telegram\Http\Http} can be tested for what it does
 * with an envelope, an error, and a `retry_after`.
 */
final class FakeDriver implements DriverInterface
{
    /** @var list<Request> Every request the transport handed over. */
    public array $requests = [];

    /** @var list<ResponseInterface|\Throwable> Answers, consumed in order. */
    public array $responses = [];

    public function __construct(ResponseInterface|\Throwable ...$responses)
    {
        $this->responses = $responses;
    }

    /** A `200` carrying a successful Bot API envelope. */
    public static function ok(mixed $result): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode(['ok' => true, 'result' => $result]));
    }

    /** An error envelope, with the status Telegram would have used. */
    public static function error(int $code, string $description, array $parameters = []): Response
    {
        $body = ['ok' => false, 'error_code' => $code, 'description' => $description];

        if ($parameters !== []) {
            $body['parameters'] = $parameters;
        }

        return new Response($code, ['Content-Type' => 'application/json'], json_encode($body));
    }

    /** A plain body, as a file download returns. */
    public static function raw(string $body, int $status = 200): Response
    {
        return new Response($status, [], $body);
    }

    public function runRequest(Request $request): PromiseInterface
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses) ?? self::ok(true);

        return $response instanceof \Throwable ? reject($response) : resolve($response);
    }

    /** The most recent request, for asserting on what was sent. */
    public function lastRequest(): ?Request
    {
        return $this->requests === [] ? null : $this->requests[array_key_last($this->requests)];
    }
}
