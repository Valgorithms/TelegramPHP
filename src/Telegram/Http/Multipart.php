<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Http;

use Telegram\Builders\InputFile;

/**
 * Encodes a Bot API payload as `multipart/form-data`, which is the only way to
 * upload a file.
 *
 * Telegram takes uploads two ways, and this class emits both from the same
 * payload: a top-level file field (`photo`, `document`, `thumbnail`, ...) is sent
 * as a form part under its own name, while a file nested inside an object - the
 * `media` of an `InputMedia`, a sticker in `createNewStickerSet` - is replaced by
 * an `attach://<name>` reference and sent as a part under that generated name.
 *
 * @link https://core.telegram.org/bots/api#sending-files
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Multipart
{
    /** @var list<array{name: string, contents: string, filename: ?string, contentType: ?string}> */
    private array $parts = [];

    private function __construct(private readonly string $boundary)
    {
    }

    /**
     * Builds the body for a payload that contains at least one {@see InputFile}.
     *
     * @param array<string, mixed> $content
     */
    public static function encode(array $content, ?string $boundary = null): self
    {
        $multipart = new self($boundary ?? 'TelegramPHP' . bin2hex(random_bytes(16)));
        $attachments = 0;

        foreach ($content as $field => $value) {
            if ($value instanceof InputFile) {
                // A file sent as the field itself - no attach:// indirection needed.
                $multipart->addFile((string) $field, $value);

                continue;
            }

            $value = $multipart->extract($value, $attachments);

            $multipart->addField((string) $field, is_scalar($value) || $value === null
                ? self::stringify($value)
                : json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR));
        }

        return $multipart;
    }

    /**
     * Walks a nested value, swapping every {@see InputFile} for an `attach://`
     * reference and registering the bytes as a part.
     */
    private function extract(mixed $value, int &$attachments): mixed
    {
        if ($value instanceof InputFile) {
            $name = 'file' . ++$attachments;
            $this->addFile($name, $value);

            return 'attach://' . $name;
        }

        if ($value instanceof \JsonSerializable) {
            $value = $value->jsonSerialize();
        }

        if (is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = $this->extract($item, $attachments);
            }
        }

        return $value;
    }

    private function addFile(string $name, InputFile $file): void
    {
        $this->parts[] = [
            'name' => $name,
            'contents' => $file->getContents(),
            'filename' => $file->getFilename(),
            'contentType' => $file->getContentType(),
        ];
    }

    private function addField(string $name, string $value): void
    {
        $this->parts[] = ['name' => $name, 'contents' => $value, 'filename' => null, 'contentType' => null];
    }

    /** The `Content-Type` header this body must be sent with. */
    public function getContentType(): string
    {
        return 'multipart/form-data; boundary=' . $this->boundary;
    }

    public function getBoundary(): string
    {
        return $this->boundary;
    }

    /** The encoded body. */
    public function __toString(): string
    {
        $body = '';

        foreach ($this->parts as $part) {
            $disposition = 'form-data; name="' . $part['name'] . '"';
            if ($part['filename'] !== null) {
                $disposition .= '; filename="' . $part['filename'] . '"';
            }

            $body .= '--' . $this->boundary . "\r\n";
            $body .= 'Content-Disposition: ' . $disposition . "\r\n";
            if ($part['contentType'] !== null) {
                $body .= 'Content-Type: ' . $part['contentType'] . "\r\n";
            }
            $body .= "\r\n" . $part['contents'] . "\r\n";
        }

        return $body . '--' . $this->boundary . "--\r\n";
    }

    /** Scalars go over the wire the way Telegram expects to read them back. */
    private static function stringify(mixed $value): string
    {
        return match (true) {
            $value === null => '',
            is_bool($value) => $value ? 'true' : 'false',
            default => (string) $value,
        };
    }

    /** True when the payload holds a file anywhere, at any depth. */
    public static function containsFile(mixed $value): bool
    {
        if ($value instanceof InputFile) {
            return true;
        }

        if ($value instanceof \JsonSerializable) {
            $value = $value->jsonSerialize();
        }

        if (is_array($value)) {
            foreach ($value as $item) {
                if (self::containsFile($item)) {
                    return true;
                }
            }
        }

        return false;
    }
}
