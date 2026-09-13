<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http\Drivers;

use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Http\Browser;
use React\Promise\PromiseInterface;
use React\Socket\Connector;
use Telegram\Http\DriverInterface;
use Telegram\Http\Request;

/**
 * The default {@see DriverInterface}: a non-blocking {@see Browser} from
 * `react/http`.
 *
 * Error responses resolve rather than reject, so {@see \Telegram\Http\Http} can
 * read Telegram's `{"ok": false, ...}` body and map it to a typed exception. The
 * timeout is generous because long polling holds a connection open for the whole
 * of its `timeout` parameter.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class React implements DriverInterface
{
    private Browser $browser;

    /**
     * @param array<string, mixed> $socketOptions Passed to `React\Socket\Connector`
     *                                            (e.g. a `tls.cafile` on Windows).
     */
    public function __construct(LoopInterface $loop, array $socketOptions = [], float $timeout = 120.0)
    {
        $this->browser = (new Browser($socketOptions === [] ? null : new Connector($socketOptions, $loop), $loop))
            ->withRejectErrorResponse(false)
            ->withTimeout($timeout)
            ->withFollowRedirects(false);
    }

    /**
     * @return PromiseInterface<ResponseInterface>
     */
    public function runRequest(Request $request): PromiseInterface
    {
        return $this->browser->request(
            $request->getMethod(),
            $request->getUrl(),
            $request->getHeaders(),
            $request->getContent(),
        );
    }
}
