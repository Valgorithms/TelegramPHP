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

use PHPUnit\Framework\TestCase;
use Telegram\Telegram;

/**
 * Shared plumbing for the tests that check the library against the spec.
 *
 * `spec/openapi.json` is the contract: it is generated from the Bot API
 * description and is what the code generator reads, so a test that reads it too
 * is asking "does the shipped library cover the API the spec describes?" rather
 * than "does the generator agree with itself?".
 */
abstract class SpecTestCase extends TestCase
{
    /** @var array<string, mixed> */
    private static array $document = [];

    /** The parsed `spec/openapi.json`, loaded once for the whole suite. */
    protected static function document(): array
    {
        if (self::$document === []) {
            $path = dirname(__DIR__) . '/spec/openapi.json';

            self::assertFileExists($path, 'spec/openapi.json is missing - run `composer spec:build`.');

            self::$document = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        }

        return self::$document;
    }

    /** @return array<string, array<string, mixed>> Operation id => operation. */
    protected static function operations(): array
    {
        $operations = [];

        foreach (self::document()['paths'] as $path => $item) {
            $operations[ltrim($path, '/')] = $item['post'];
        }

        return $operations;
    }

    /** @return array<string, array<string, mixed>> Type name => schema. */
    protected static function schemas(): array
    {
        return self::document()['components']['schemas'];
    }

    /**
     * The request body properties of an operation.
     *
     * @return array<string, array<string, mixed>>
     */
    protected static function parameters(array $operation): array
    {
        return $operation['requestBody']['content']['application/json']['schema']['properties'] ?? [];
    }

    /** @return list<string> */
    protected static function requiredParameters(array $operation): array
    {
        return $operation['requestBody']['content']['application/json']['schema']['required'] ?? [];
    }

    /**
     * Every Bot API method, as a PHPUnit data set.
     *
     * @return \Generator<string, array{0: string, 1: array<string, mixed>}>
     */
    public static function operationProvider(): \Generator
    {
        foreach (self::operations() as $name => $operation) {
            yield $name => [$name, $operation];
        }
    }

    /**
     * Every Bot API type, as a PHPUnit data set.
     *
     * @return \Generator<string, array{0: string, 1: array<string, mixed>}>
     */
    public static function schemaProvider(): \Generator
    {
        foreach (self::schemas() as $name => $schema) {
            yield $name => [$name, $schema];
        }
    }

    /** A client whose transport is a recorder. */
    protected function client(?ScriptedHttp $http = null): Telegram
    {
        return new Telegram(['token' => 'TEST:TOKEN', 'http' => $http ?? new ScriptedHttp()]);
    }
}
