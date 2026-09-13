<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Api;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * Every Bot API method, gathered from the per-topic traits into the one trait
 * {@see \Telegram\Telegram} uses. The client supplies {@see callApi()}, which
 * drops unset arguments, encodes what is left, and hydrates the result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since Bot API 10.3
 */
trait Methods
{
    use BotApi;
    use BusinessApi;
    use ChatApi;
    use FileApi;
    use GameApi;
    use GiftApi;
    use InlineApi;
    use MessageApi;
    use PassportApi;
    use PaymentApi;
    use StickerApi;
    use UpdateApi;

    /**
     * Dispatches one Bot API call.
     *
     * @param array<string, mixed> $arguments The method's arguments, unset ones included.
     * @param list<string>         $returns   Telegram type tokens the result hydrates as.
     *
     * @return PromiseInterface<mixed>
     */
    abstract protected function callApi(string $method, array $arguments, array $returns): \React\Promise\PromiseInterface;
}
