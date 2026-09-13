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
use Telegram\Exceptions\TelegramException;

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
    /** The download URL for this file, bot token included - so do not log it. */
    public function getUrl(): string
    {
        if ($this->file_path === null) {
            throw new TelegramException('This File has no file_path; call getFile() with its file_id first.');
        }

        return $this->telegram->getHttp()->fileUrl($this->file_path);
    }

    /**
     * Downloads the file.
     *
     * @return PromiseInterface<string> The file's bytes.
     */
    public function download(): PromiseInterface
    {
        if ($this->file_path === null) {
            throw new TelegramException('This File has no file_path; call getFile() with its file_id first.');
        }

        return $this->telegram->getHttp()->download($this->file_path);
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
            $path = rtrim($path, '/\\') . DIRECTORY_SEPARATOR . basename((string) $this->file_path);
        }

        return $this->download()->then(static function (string $contents) use ($path): string {
            if (file_put_contents($path, $contents) === false) {
                throw new TelegramException("Could not write the downloaded file to {$path}.");
            }

            return $path;
        });
    }
}
