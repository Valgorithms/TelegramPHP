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
 * The builder is `discord-php/phpdoc-tool` - phpDocumentor with the DiscordPHP
 * family's two patches, so that `?T|null` is read as a type rather than an error
 * and printed back as `?T`. The generated parts document their attributes that
 * way throughout, so plain phpDocumentor would render a good deal of this API
 * surface wrongly. It is the same builder DiscordPHP and TwitchPHP use.
 *
 * This looks for it in the usual places; point PHPDOC at a `phpdoc` binary or a
 * PHAR to use a specific build.
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
    $candidates = [];

    $configured = getenv('PHPDOC');

    if (is_string($configured) && $configured !== '') {
        $candidates[] = $configured;
    }

    $candidates[] = $root . '/phpdoc-tool/vendor/bin/phpdoc';        // created here, as CI does
    $candidates[] = dirname($root) . '/phpdoc-tool/vendor/bin/phpdoc'; // a checkout beside this one
    $candidates[] = dirname($root) . '/phpdoc-tool-shared/vendor/bin/phpdoc';

    foreach ($candidates as $candidate) {
        if (is_file($candidate)) {
            return str_ends_with($candidate, '.phar') ? [PHP_BINARY, $candidate] : [PHP_BINARY, $candidate];
        }
    }

    return [];
};

$command = $locate();

if ($command === []) {
    fwrite(STDERR, <<<'TEXT'
        The documentation builder was not found.

        This project builds its docs with discord-php/phpdoc-tool - phpDocumentor
        plus the DiscordPHP family's patches for `?T|null` types. It is not on
        Packagist, so install it from its repository:

            composer create-project discord-php/phpdoc-tool:^1.0 phpdoc-tool \
              --no-interaction --no-progress \
              --repository='{"type":"vcs","url":"https://github.com/discord-php/phpdoc-tool"}'

        Or point this at an existing checkout:

            PHPDOC=../phpdoc-tool/vendor/bin/phpdoc composer docs

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
