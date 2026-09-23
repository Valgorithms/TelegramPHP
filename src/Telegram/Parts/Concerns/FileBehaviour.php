<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts\Concerns;

use React\Promise\PromiseInterface;

use function React\Promise\reject;

use Telegram\Exceptions\TelegramException;
use Telegram\Http\LocalFiles;

/**
 * Getting the bytes behind a {@see \Telegram\Parts\File}.
 *
 * A `file_path` is valid for at least an hour; after that, call `getFile` again
 * with the same `file_id` for a fresh one.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait FileBehaviour
{
    /**
     * The download URL for this file, bot token included - so do not log it.
     *
     * @throws TelegramException For a file on a local Bot API server, which has
     *                           no URL - see {@see localPath()}.
     */
    public function getUrl(): string
    {
        if ($this->file_path === null) {
            throw new TelegramException('This File has no file_path; call getFile() with its file_id first.');
        }

        if ($this->isLocal()) {
            throw new TelegramException('This file is on a local Bot API server, which does not serve it over HTTP; use localPath().');
        }

        return $this->telegram->getHttp()->fileUrl($this->file_path);
    }

    /** Whether the file is on a local Bot API server's disk rather than Telegram's. */
    public function isLocal(): bool
    {
        return LocalFiles::isLocalPath($this->file_path);
    }

    /**
     * Where the file is on this process's disk, for a local Bot API server.
     *
     * @throws TelegramException When it is not a local file, or not under the
     *                           client's `local_files` option.
     */
    public function localPath(): string
    {
        if (! $this->isLocal()) {
            throw new TelegramException('This file is on Telegram\'s servers; download() it instead.');
        }

        return $this->telegram->getLocalFiles()->toLocal((string) $this->file_path);
    }

    /**
     * Downloads the file - or, from a local Bot API server, reads it.
     *
     * @return PromiseInterface<string> The file's bytes.
     */
    public function download(): PromiseInterface
    {
        if ($this->file_path === null) {
            throw new TelegramException('This File has no file_path; call getFile() with its file_id first.');
        }

        return $this->telegram->downloadFile($this);
    }

    /**
     * Downloads the file and writes it to disk.
     *
     * @param string $path Where to write. A directory takes the file's own name.
     *
     * @return PromiseInterface<string> The path written to.
     */
    public function save(string $path): PromiseInterface
    {
        if (is_dir($path)) {
            $path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . basename(str_replace('\\', '/', (string) $this->file_path));
        }

        // A local server's file can be copied without ever being held in
        // memory, which matters for the sizes a local server allows.
        if ($this->isLocal()) {
            try {
                $source = $this->localPath();
            } catch (\Throwable $e) {
                return reject($e);
            }

            return $this->telegram->getLocalFiles()->copy($source, $path);
        }

        return $this->download()->then(static function (string $contents) use ($path): string {
            if (file_put_contents($path, $contents) === false) {
                throw new TelegramException("Could not write the downloaded file to {$path}.");
            }

            return $path;
        });
    }
}
