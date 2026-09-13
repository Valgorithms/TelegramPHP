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

/**
 * The bundled `spec/openapi.json` is a well-formed OpenAPI document that
 * describes the same API as the upstream scrape it was built from.
 *
 * Everything else in the suite reads this document as the contract, so if it
 * drifts from `spec/api.json` the rest of the suite is measuring the wrong thing.
 */
final class OpenApiDocumentTest extends SpecTestCase
{
    /** @var array<string, mixed> */
    private static array $upstream = [];

    /** The scraped Bot API description the document is generated from. */
    private static function upstream(): array
    {
        if (self::$upstream === []) {
            $path = dirname(__DIR__) . '/spec/api.json';

            self::assertFileExists($path, 'spec/api.json is missing - run `composer spec:fetch`.');

            self::$upstream = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        }

        return self::$upstream;
    }

    public function testTheDocumentIsOpenApi31(): void
    {
        $document = self::document();

        $this->assertSame('3.1.0', $document['openapi']);
        $this->assertSame('Telegram Bot API', $document['info']['title']);
        $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $document['info']['version']);
        $this->assertSame('https://api.telegram.org/bot{token}', $document['servers'][0]['url']);
        $this->assertArrayHasKey('botToken', $document['components']['securitySchemes']);
        $this->assertSame([['botToken' => []]], $document['security']);
    }

    public function testTheDocumentDescribesTheSameApiAsTheScrape(): void
    {
        $upstream = self::upstream();

        $this->assertSame($upstream['version'], self::document()['x-bot-api-version']);
        $this->assertSame(
            preg_replace('/[^0-9.]/', '', (string) $upstream['version']),
            self::document()['info']['version'],
        );
        $this->assertCount(count($upstream['methods']), self::operations(), 'Every Bot API method needs an operation.');
        $this->assertCount(count($upstream['types']), self::schemas(), 'Every Bot API type needs a schema.');

        foreach (array_keys($upstream['methods']) as $method) {
            $this->assertArrayHasKey($method, self::operations(), "The document is missing the method {$method}.");
        }

        foreach (array_keys($upstream['types']) as $type) {
            $this->assertArrayHasKey($type, self::schemas(), "The document is missing the type {$type}.");
        }
    }

    #[DataProvider('operationProvider')]
    public function testEveryOperationIsComplete(string $name, array $operation): void
    {
        $this->assertSame($name, $operation['operationId']);
        $this->assertNotSame('', $operation['description'], "{$name} has no description.");
        $this->assertStringStartsWith('https://core.telegram.org/bots/api#', $operation['externalDocs']['url']);
        $this->assertNotEmpty($operation['x-telegram-returns'], "{$name} does not say what it returns.");
        $this->assertArrayHasKey('200', $operation['responses']);
        $this->assertArrayHasKey('default', $operation['responses']);

        $result = $operation['responses']['200']['content']['application/json']['schema'];

        $this->assertSame(['ok', 'result'], $result['required']);
        $this->assertTrue($result['properties']['ok']['const']);
    }

    #[DataProvider('operationProvider')]
    public function testUploadsAreOfferedAsMultipart(string $name, array $operation): void
    {
        $mentionsAFile = false;

        foreach (self::parameters($operation) as $schema) {
            foreach ($schema['x-telegram-types'] ?? [] as $token) {
                $mentionsAFile = $mentionsAFile || str_contains($token, 'InputFile');
            }
        }

        $content = $operation['requestBody']['content'] ?? [];

        $this->assertSame(
            $mentionsAFile,
            isset($content['multipart/form-data']),
            "{$name}: multipart should be offered exactly when a field takes an InputFile.",
        );

        if (self::parameters($operation) !== []) {
            $this->assertArrayHasKey('application/json', $content, "{$name} must accept a JSON body.");
        }
    }

    #[DataProvider('schemaProvider')]
    public function testEverySchemaIsComplete(string $name, array $schema): void
    {
        $this->assertSame($name, $schema['title']);
        $this->assertStringStartsWith('https://core.telegram.org/bots/api#', $schema['externalDocs']['url']);

        if (isset($schema['x-telegram-subtypes'])) {
            $this->assertNotEmpty($schema['oneOf'], "{$name} is a union and must list its members.");

            return;
        }

        $this->assertSame('object', $schema['type']);

        foreach ($schema['properties'] ?? [] as $field => $property) {
            $this->assertNotEmpty($property['x-telegram-types'], "{$name}.{$field} has no Telegram type.");
            $this->assertArrayHasKey('description', $property, "{$name}.{$field} has no description.");
        }

        foreach ($schema['required'] ?? [] as $field) {
            $this->assertArrayHasKey($field, $schema['properties'], "{$name} requires {$field}, which it does not define.");
        }
    }

    public function testEveryReferenceResolves(): void
    {
        $schemas = self::schemas();
        $document = self::document();
        $refs = [];

        array_walk_recursive($document, static function (mixed $value, string|int $key) use (&$refs): void {
            if ($key === '$ref' && is_string($value)) {
                $refs[$value] = true;
            }
        });

        $this->assertNotEmpty($refs, 'A document with no references is suspicious.');

        foreach (array_keys($refs) as $ref) {
            if (str_starts_with($ref, '#/components/schemas/')) {
                $this->assertArrayHasKey(basename($ref), $schemas, "{$ref} points at a type that does not exist.");

                continue;
            }

            $this->assertSame('#/components/responses/Error', $ref, "Unexpected reference {$ref}.");
        }
    }

    public function testDiscriminatorMappingsPointAtMembersOfTheirUnion(): void
    {
        foreach (self::schemas() as $name => $schema) {
            if (! isset($schema['discriminator'])) {
                continue;
            }

            $members = $schema['x-telegram-subtypes'];

            foreach ($schema['discriminator']['mapping'] as $value => $ref) {
                $this->assertContains(
                    basename($ref),
                    $members,
                    "{$name}: the tag \"{$value}\" maps to something outside the union.",
                );
            }

            $this->assertCount(
                count($members),
                $schema['discriminator']['mapping'],
                "{$name}: every member needs a tag, or none should have one.",
            );
        }
    }

    public function testTheDocumentIsWhatTheGeneratorWouldWriteToday(): void
    {
        $document = self::document();

        // A hand-edited document would drift from the code the generator emits,
        // which is the one thing the rest of the suite cannot catch.
        $this->assertStringContainsString('composer spec:build', $document['info']['description']);
        $this->assertSame(
            json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n",
            (string) file_get_contents(dirname(__DIR__) . '/spec/openapi.json'),
            'spec/openapi.json is not formatted the way the generator writes it - re-run `composer spec:openapi`.',
        );
    }
}
