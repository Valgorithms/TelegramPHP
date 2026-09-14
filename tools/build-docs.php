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
 * Builds the documentation site into `build/`: the API reference from the source,
 * and the guide from `guide/*.rst`, both by phpDocumentor.
 *
 * Usage: composer docs
 *
 * phpDocumentor is not a Composer dependency (it is distributed as a PHAR, and
 * pulling it in as a library drags half of Symfony behind it), so this looks for
 * one in the usual places. Point PHPDOCUMENTOR at a PHAR to use a specific build.
 *
 * Note that every page links relative to the site root and carries a
 * `<base href="../">` to make that work, so the site only resolves correctly when
 * `build/` is served as a directory - opening a page straight off the filesystem
 * in a browser will not find its stylesheets.
 */

$root = dirname(__DIR__);

// -- find phpDocumentor -------------------------------------------------------

/** @return list<string> The command to run, or [] when nothing suitable was found. */
$locate = static function () use ($root): array {
    $configured = getenv('PHPDOCUMENTOR');

    if (is_string($configured) && $configured !== '') {
        return str_ends_with($configured, '.phar') ? [PHP_BINARY, $configured] : [$configured];
    }

    foreach ([$root . '/tools/phpDocumentor', $root . '/tools/phpDocumentor.phar', $root . '/phpDocumentor.phar'] as $local) {
        if (is_file($local)) {
            return str_ends_with($local, '.phar') ? [PHP_BINARY, $local] : [$local];
        }
    }

    foreach (['phpDocumentor', 'phpdoc'] as $binary) {
        $which = PHP_OS_FAMILY === 'Windows' ? "where {$binary}" : "command -v {$binary}";
        $found = trim((string) @shell_exec($which . ' 2>' . (PHP_OS_FAMILY === 'Windows' ? 'NUL' : '/dev/null')));

        if ($found !== '') {
            return [strtok($found, "\r\n")];
        }
    }

    return [];
};

$command = $locate();

if ($command === []) {
    fwrite(STDERR, <<<'TEXT'
        phpDocumentor was not found.

        Install it with phive:

            phive install phpDocumentor --trust-gpg-keys 67F861C3D889C656,6DA3ACC4991FFAE5

        or download the PHAR and point this at it:

            PHPDOCUMENTOR=/path/to/phpDocumentor.phar composer docs

        TEXT);
    exit(1);
}

// -- build --------------------------------------------------------------------

$arguments = array_map('escapeshellarg', [...$command, '--config', $root . '/phpdoc.dist.xml', '--no-interaction']);

fwrite(STDERR, "Building the documentation...\n");

passthru(implode(' ', $arguments), $status);

if ($status !== 0) {
    fwrite(STDERR, "phpDocumentor exited with {$status}.\n");
    exit($status);
}

// -- check what came out ------------------------------------------------------

$guideDir = $root . '/build/guide';

if (! is_dir($guideDir)) {
    fwrite(STDERR, "No guide was built - check that guides.enabled is set in phpdoc.dist.xml.\n");
    exit(1);
}

$pages = glob($guideDir . '/*.html');
$sources = glob($root . '/guide/*.rst');
$expected = count($sources);

if (count($pages) < $expected) {
    fwrite(STDERR, sprintf(
        "Only %d of %d guide pages were built - look for an RST error above.\n",
        count($pages),
        $expected,
    ));
    exit(1);
}

printf("Built %d guide pages and the API reference into %s/build.\n", count($pages), $root);
printf("Serve that directory to read it: php -S localhost:8000 -t build\n");
