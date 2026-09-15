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
 * Shared setup for the examples: the autoloader, the `.env` file next to it, and
 * a CA bundle for Windows builds of PHP that ship without one.
 *
 * The library itself reads no configuration and needs no dotenv package - this is
 * only so the examples can be run straight out of a checkout:
 *
 *     cp example.env .env   # then put your token in it
 *     php examples/ping.php
 *
 * Values already in the real environment win, so `TELEGRAM_TOKEN=… php examples/ping.php`
 * still works and overrides the file.
 */

require __DIR__ . '/../vendor/autoload.php';

(static function (): void {
    $path = __DIR__ . '/../.env';

    if (! is_readable($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || ! str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);

        if ($key === '' || getenv($key) !== false) {
            continue;
        }

        putenv($key . '=' . trim(trim($value), "\"'"));
    }
})();

/**
 * The socket options the client needs on this machine.
 *
 * A Windows PHP build usually has no CA bundle, so TLS to api.telegram.org fails
 * with "Connection lost" until one is pointed at. Everywhere else this is empty
 * and the system store is used.
 *
 * @return array<string, mixed>
 */
function socket_options(): array
{
    foreach ([ini_get('openssl.cafile'), getenv('SSL_CERT_FILE'), 'C:/php/cacert.pem'] as $cafile) {
        if (is_string($cafile) && $cafile !== '' && is_file($cafile)) {
            return ['tls' => ['cafile' => $cafile]];
        }
    }

    return [];
}

/** The bot token, or a clear complaint about where to put one. */
function bot_token(): string
{
    $token = getenv('TELEGRAM_TOKEN');

    if (! is_string($token) || $token === '') {
        fwrite(STDERR, "No TELEGRAM_TOKEN found.\n\nPut one in a .env file next to composer.json (see example.env), or pass it in the environment:\n\n    TELEGRAM_TOKEN=123456:ABC php " . ($_SERVER['argv'][0] ?? 'examples/ping.php') . "\n");
        exit(1);
    }

    return $token;
}
