<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Telegram\Builders\InputFile;
use Telegram\Http\Multipart;

/**
 * Every documented field of every method actually reaches the wire.
 *
 * Each Bot API method is called twice against a recording transport: once with
 * every field the spec documents, and once with only the required ones. The
 * first run proves nothing is dropped between the signature and the request; the
 * second proves an omitted optional field is left out of the payload rather than
 * sent as null, which Telegram would reject.
 */
final class ParameterDispatchTest extends SpecTestCase
{
    #[DataProvider('operationProvider')]
    public function testEveryDocumentedFieldReachesTheRequest(string $name, array $operation): void
    {
        $http = new ScriptedHttp();
        $client = $this->client($http);

        $arguments = [];
        foreach (self::parameters($operation) as $field => $schema) {
            $arguments[$field] = self::sampleFor($schema['x-telegram-types'] ?? ['String'], $field);
        }

        $client->{$name}(...$arguments);

        [$called, $payload] = $http->lastCall();

        $this->assertSame($name, $called, 'The call must go to the Bot API method of the same name.');

        foreach ($arguments as $field => $value) {
            $this->assertArrayHasKey($field, $payload, "Telegram::{$name}(): \${$field} never reached the request.");
            $this->assertSame($value, $payload[$field], "Telegram::{$name}(): \${$field} was altered on the way out.");
        }

        $this->assertSame(
            [],
            array_diff(array_keys($payload), array_keys($arguments)),
            "Telegram::{$name}(): the request carries fields the spec does not document.",
        );
    }

    #[DataProvider('operationProvider')]
    public function testOmittedOptionalFieldsAreNotSent(string $name, array $operation): void
    {
        $http = new ScriptedHttp();
        $client = $this->client($http);

        $required = self::requiredParameters($operation);
        $arguments = [];

        foreach (self::parameters($operation) as $field => $schema) {
            if (in_array($field, $required, true)) {
                $arguments[$field] = self::sampleFor($schema['x-telegram-types'] ?? ['String'], $field);
            }
        }

        $client->{$name}(...$arguments);

        $payload = array_filter($http->lastPayload(), static fn ($value): bool => $value !== null);

        $this->assertSame(
            array_keys($arguments),
            array_keys($payload),
            "Telegram::{$name}(): only the fields that were passed should be sent.",
        );
    }

    public function testAFileArgumentTurnsTheRequestIntoAnUpload(): void
    {
        $payload = [
            'chat_id' => 42,
            'photo' => InputFile::fromString('binary', 'cat.jpg', 'image/jpeg'),
            'caption' => 'mine',
        ];

        $this->assertTrue(Multipart::containsFile($payload));

        $body = (string) Multipart::encode($payload, 'BOUNDARY');

        $this->assertStringContainsString('--BOUNDARY', $body);
        $this->assertStringContainsString('Content-Disposition: form-data; name="chat_id"', $body);
        $this->assertStringContainsString("\r\n\r\n42\r\n", $body);
        $this->assertStringContainsString('Content-Disposition: form-data; name="photo"; filename="cat.jpg"', $body);
        $this->assertStringContainsString('Content-Type: image/jpeg', $body);
        $this->assertStringContainsString('binary', $body);
        $this->assertStringEndsWith("--BOUNDARY--\r\n", $body);
    }

    public function testAFileNestedInAnObjectBecomesAnAttachReference(): void
    {
        $body = (string) Multipart::encode([
            'chat_id' => 1,
            'media' => [
                ['type' => 'photo', 'media' => InputFile::fromString('first', 'a.jpg')],
                ['type' => 'photo', 'media' => InputFile::fromString('second', 'b.jpg')],
            ],
        ], 'BOUNDARY');

        $this->assertStringContainsString('attach://file1', $body);
        $this->assertStringContainsString('attach://file2', $body);
        $this->assertStringContainsString('name="file1"; filename="a.jpg"', $body);
        $this->assertStringContainsString('name="file2"; filename="b.jpg"', $body);
    }

    /**
     * A value of the right shape for a field, built from the Telegram type tokens
     * the spec records for it.
     *
     * @param list<string> $tokens
     */
    private static function sampleFor(array $tokens, string $field): mixed
    {
        $token = $tokens[0];

        if (str_starts_with($token, 'Array of ')) {
            return [self::sampleFor([substr($token, strlen('Array of '))], $field)];
        }

        return match ($token) {
            'Integer' => 1234,
            'Float' => 1.5,
            'Boolean', 'True' => true,
            'String' => 'sample-' . $field,
            'InputFile' => InputFile::fromString('bytes-' . $field, $field . '.bin'),
            default => ['sample' => $field],
        };
    }
}
