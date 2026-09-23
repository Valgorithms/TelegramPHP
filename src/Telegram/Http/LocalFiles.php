<?php

declare(strict_types=1);

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http;

use React\EventLoop\LoopInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;

use function React\Promise\reject;

use Telegram\Exceptions\FileNotFoundException;
use Telegram\Exceptions\TelegramException;

/**
 * Files on a local Bot API server's disk, as this process can reach them.
 *
 * A [local Bot API server](https://core.telegram.org/bots/api#using-a-local-bot-api-server)
 * started with `--local` stops serving files over HTTP. `getFile` answers with
 * the absolute path the file has *on the server's disk* instead, and the bot is
 * expected to read it from there — which is how it lifts the 20 MB download
 * limit. Uploads can go the other way: a `file://` URI instead of the bytes.
 *
 * Where the server's disk is, as far as this process is concerned, is the
 * `local_files` option:
 *
 * ```php
 * // Same machine: the server's paths are this process's paths.
 * 'local_files' => ['C:\telegram-bot-api'],
 *
 * // In Docker: the server's path on the left, the mounted volume on the right.
 * 'local_files' => ['/var/lib/telegram-bot-api' => 'D:\telegram-bot-api'],
 * ```
 *
 * Only files under those directories are ever read. The path comes from the
 * server, and a client that followed wherever it pointed would read — and hand
 * to whatever uploads it next — any file this process can open.
 *
 * Reads are chunked across loop ticks, so a large file does not stall the loop
 * the way one blocking read would. That is the Windows-safe way to do it: files
 * cannot be put in non-blocking mode there, so there is no stream to wait on.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class LocalFiles
{
    /** How much is read per loop tick. */
    public const CHUNK = 1048576;

    /** @var list<array{server: string, local: string}> */
    private readonly array $roots;

    /**
     * @param array<int|string, string> $roots A path the server and this process
     *                                         share (list entries), or the server's
     *                                         path mapped to this process's (keys).
     * @param int<1, max>                $chunk Bytes read per loop tick.
     */
    public function __construct(
        array $roots,
        private readonly LoopInterface $loop,
        private readonly int $chunk = self::CHUNK,
    ) {
        $normalised = [];

        foreach ($roots as $server => $local) {
            $local = trim((string) $local);

            if ($local === '') {
                throw new \InvalidArgumentException('A `local_files` entry cannot be empty.');
            }

            $server = is_int($server) ? $local : trim($server);
            $normalised[] = ['server' => self::rtrimSeparators($server), 'local' => self::rtrimSeparators($local)];
        }

        $this->roots = $normalised;
    }

    /**
     * Whether a `file_path` is a path on a local server's disk rather than one
     * relative to `https://…/file/bot<token>/`.
     *
     * The cloud's are always relative (`photos/file_12.jpg`); a local server's
     * are absolute — POSIX, a drive letter, or a UNC share.
     */
    public static function isLocalPath(?string $filePath): bool
    {
        if ($filePath === null || $filePath === '') {
            return false;
        }

        return $filePath[0] === '/'
            || preg_match('#^[A-Za-z]:[\\\\/]#', $filePath) === 1
            || str_starts_with($filePath, '\\\\');
    }

    /** Whether any directory was configured at all. */
    public function isConfigured(): bool
    {
        return $this->roots !== [];
    }

    /**
     * Where a path the server reported is on this process's disk.
     *
     * @throws TelegramException    When no configured directory covers it, or it
     *                              resolves outside the one that does.
     * @throws FileNotFoundException When it is covered but not there.
     */
    public function toLocal(string $serverPath): string
    {
        if (! $this->isConfigured()) {
            throw new TelegramException(
                'The Bot API server answered with a path on its own disk, so it runs with --local. '
                . 'Set the `local_files` option to where this process can read those files.',
            );
        }

        foreach ($this->roots as $root) {
            $rest = self::under($serverPath, $root['server']);

            if ($rest === null) {
                continue;
            }

            $candidate = $root['local'] . ($rest === '' ? '' : DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $rest));
            $real = realpath($candidate);

            if ($real === false || ! is_file($real)) {
                throw new FileNotFoundException("The local Bot API server's file is not at {$candidate}.");
            }

            $realRoot = realpath($root['local']);

            if ($realRoot === false || self::under($real, $realRoot) === null) {
                // `..` segments, or a link out of the directory.
                throw new TelegramException("Refusing to read {$serverPath}: it resolves outside {$root['local']}.");
            }

            return $real;
        }

        throw new TelegramException("{$serverPath} is not under any directory in the `local_files` option.");
    }

    /**
     * A local file as a `file://` URI the server can read, for uploading it
     * without sending its bytes.
     *
     * Pass the result wherever a method takes `InputFile or String`:
     *
     * ```php
     * $telegram->sendDocument($chatId, $telegram->getLocalFiles()->toUri('D:\telegram-bot-api\big.mkv'));
     * ```
     *
     * @throws TelegramException When the file is not under a configured directory,
     *                           so the server would not be able to see it.
     */
    public function toUri(string $localPath): string
    {
        $real = realpath($localPath);

        if ($real === false || ! is_file($real)) {
            throw new FileNotFoundException("Cannot read the file to upload: {$localPath}");
        }

        foreach ($this->roots as $root) {
            $realRoot = realpath($root['local']);
            $rest = $realRoot === false ? null : self::under($real, $realRoot);

            if ($rest === null) {
                continue;
            }

            $serverPath = str_replace('\\', '/', $root['server'] . ($rest === '' ? '' : '/' . $rest));
            $segments = array_map(
                // A drive letter stays as it is; everything else is encoded, so
                // a space or a `#` in a filename survives the trip.
                static fn (string $segment): string => preg_match('/^[A-Za-z]:$/', $segment) === 1 ? $segment : rawurlencode($segment),
                explode('/', ltrim($serverPath, '/')),
            );

            return 'file:///' . implode('/', $segments);
        }

        throw new TelegramException("{$localPath} is not under any directory in the `local_files` option, so the server cannot see it.");
    }

    /**
     * Reads a file, a chunk per loop tick.
     *
     * @return PromiseInterface<string> The file's bytes.
     */
    public function read(string $localPath): PromiseInterface
    {
        $contents = '';

        return $this->pump($localPath, static function (string $chunk) use (&$contents): void {
            $contents .= $chunk;
        })->then(static function () use (&$contents): string {
            return $contents;
        });
    }

    /**
     * Copies a file, a chunk per loop tick, without holding it in memory — for
     * the files a local server exists to allow.
     *
     * @return PromiseInterface<string> The path written to.
     */
    public function copy(string $localPath, string $destination): PromiseInterface
    {
        $out = @fopen($destination, 'wb');

        if ($out === false) {
            return reject(new TelegramException("Could not write the file to {$destination}."));
        }

        return $this->pump($localPath, static function (string $chunk) use ($out, $destination): void {
            if (fwrite($out, $chunk) !== strlen($chunk)) {
                throw new TelegramException("Could not write the file to {$destination}.");
            }
        })->then(
            static function () use ($out, $destination): string {
                fclose($out);

                return $destination;
            },
            static function (\Throwable $e) use ($out): never {
                fclose($out);

                throw $e;
            },
        );
    }

    /**
     * Feeds a file to `$sink` a chunk per tick.
     *
     * @param callable(string): void $sink
     *
     * @return PromiseInterface<null>
     */
    private function pump(string $path, callable $sink): PromiseInterface
    {
        $in = @fopen($path, 'rb');

        if ($in === false) {
            return reject(new FileNotFoundException("Cannot read {$path}."));
        }

        $deferred = new Deferred();

        $step = function () use (&$step, $in, $sink, $deferred, $path): void {
            try {
                $chunk = fread($in, $this->chunk);

                if ($chunk === false) {
                    throw new TelegramException("Reading {$path} failed.");
                }

                if ($chunk !== '') {
                    $sink($chunk);
                }

                if (feof($in)) {
                    fclose($in);
                    $deferred->resolve(null);

                    return;
                }
            } catch (\Throwable $e) {
                fclose($in);
                $deferred->reject($e);

                return;
            }

            $this->loop->futureTick($step);
        };

        $this->loop->futureTick($step);

        return $deferred->promise();
    }

    /**
     * What is left of `$path` below `$root`, or `null` when it is not below it.
     *
     * Whole segments only, so `/srv/bot` does not claim `/srv/bot-two`. A root
     * that looks like a Windows path is compared without regard to case, as
     * Windows does.
     */
    private static function under(string $path, string $root): ?string
    {
        $path = str_replace('\\', '/', $path);
        $root = str_replace('\\', '/', $root);
        $caseless = preg_match('#^[A-Za-z]:/#', $root) === 1 || str_starts_with($root, '//');

        if ($root === '') {
            return null;
        }

        if ($caseless ? strcasecmp($path, $root) === 0 : $path === $root) {
            return '';
        }

        $prefix = str_ends_with($root, '/') ? $root : $root . '/';
        $head = substr($path, 0, strlen($prefix));

        if ($caseless ? strcasecmp($head, $prefix) !== 0 : $head !== $prefix) {
            return null;
        }

        return substr($path, strlen($prefix));
    }

    private static function rtrimSeparators(string $path): string
    {
        $trimmed = rtrim($path, '/\\');

        // `/` and `C:\` are roots in their own right, not empty strings.
        return $trimmed === '' || preg_match('/^[A-Za-z]:$/', $trimmed) === 1 ? $trimmed . (str_contains($path, '\\') ? '\\' : '/') : $trimmed;
    }
}
