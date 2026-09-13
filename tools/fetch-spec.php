<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

/**
 * Downloads the machine-readable Telegram Bot API specification into `spec/api.json`.
 *
 * The upstream document is scraped from https://core.telegram.org/bots/api by
 * PaulSonOfLars/telegram-bot-api-spec and is the input every other generator in
 * `tools/` reads. Run it whenever Telegram ships a new Bot API version:
 *
 *     composer spec:build
 *
 * @see https://github.com/PaulSonOfLars/telegram-bot-api-spec
 */

const SPEC_URL = 'https://raw.githubusercontent.com/PaulSonOfLars/telegram-bot-api-spec/main/api.json';

$target = dirname(__DIR__) . '/spec/api.json';

fwrite(STDERR, 'Fetching ' . SPEC_URL . " ...\n");

$context = stream_context_create([
    'http' => ['timeout' => 120, 'header' => "User-Agent: TelegramPHP-spec-fetch\r\n"],
    'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
]);

$body = @file_get_contents(SPEC_URL, false, $context);

if ($body === false) {
    fwrite(STDERR, "Failed to download the spec. Check your network connection.\n");
    exit(1);
}

$spec = json_decode($body, true);

if (! is_array($spec) || ! isset($spec['methods'], $spec['types'], $spec['version'])) {
    fwrite(STDERR, "Downloaded document is not a recognisable Bot API spec.\n");
    exit(1);
}

file_put_contents($target, json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");

printf(
    "Wrote %s — %s (%s), %d methods, %d types.\n",
    $target,
    $spec['version'],
    $spec['release_date'] ?? 'unknown release date',
    count($spec['methods']),
    count($spec['types']),
);
