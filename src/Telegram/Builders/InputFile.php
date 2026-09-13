<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Builders;

use Telegram\Exceptions\FileNotFoundException;

/**
 * A file to upload - the `InputFile` of the Bot API.
 *
 * Pass one anywhere the spec accepts `InputFile or String`, at any depth, and the
 * call switches itself to `multipart/form-data`:
 *
 * ```php
 * $telegram->sendPhoto($chatId, InputFile::fromPath('cat.jpg'), caption: 'mine');
 * ```
 *
 * Sending a `file_id` or an HTTP URL needs none of this - pass the plain string.
 *
 * @link https://core.telegram.org/bots/api#sending-files
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class InputFile implements \Stringable
{
    private function __construct(
        private readonly ?string $path,
        private readonly ?string $contents,
        private readonly string $filename,
        private readonly ?string $contentType,
    ) {
    }

    /**
     * Reads the upload from disk when the request is encoded.
     *
     * @throws FileNotFoundException When the path is not a readable file.
     */
    public static function fromPath(string $path, ?string $filename = null, ?string $contentType = null): self
    {
        if (! is_file($path) || ! is_readable($path)) {
            throw new FileNotFoundException("Cannot read the file to upload: {$path}");
        }

        return new self($path, null, $filename ?? basename($path), $contentType);
    }

    /** Uploads bytes already in memory. */
    public static function fromString(string $contents, string $filename, ?string $contentType = null): self
    {
        return new self(null, $contents, $filename, $contentType);
    }

    /**
     * Drains a stream resource into the upload.
     *
     * @param resource $stream
     */
    public static function fromStream($stream, string $filename, ?string $contentType = null): self
    {
        if (! is_resource($stream)) {
            throw new \InvalidArgumentException('InputFile::fromStream() expects an open stream resource.');
        }

        return new self(null, (string) stream_get_contents($stream), $filename, $contentType);
    }

    /** The bytes to send, read from disk on first use. */
    public function getContents(): string
    {
        if ($this->contents !== null) {
            return $this->contents;
        }

        $contents = @file_get_contents((string) $this->path);

        if ($contents === false) {
            throw new FileNotFoundException("Cannot read the file to upload: {$this->path}");
        }

        return $contents;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    /** The declared MIME type, guessed from the file when one was not given. */
    public function getContentType(): ?string
    {
        if ($this->contentType !== null) {
            return $this->contentType;
        }

        if ($this->path !== null && function_exists('mime_content_type')) {
            $guess = @mime_content_type($this->path);

            if (is_string($guess) && $guess !== '') {
                return $guess;
            }
        }

        return null;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    /** The `attach://` form a nested upload is referenced by. */
    public function attachName(): string
    {
        return 'attach://' . $this->filename;
    }

    public function __toString(): string
    {
        return $this->attachName();
    }
}
