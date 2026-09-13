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
use Telegram\Telegram;

/**
 * Every field the spec documents for a method is a parameter of the generated
 * method, named the same, typed to accept what the spec says it accepts, and
 * optional exactly when the spec says it is optional.
 *
 * This is the half of "can use every parameter" that the signature can prove;
 * {@see ParameterDispatchTest} proves the other half by watching what actually
 * goes out on the wire.
 */
final class ParameterCoverageTest extends SpecTestCase
{
    #[DataProvider('operationProvider')]
    public function testParameterNamesMatchTheSpec(string $name, array $operation): void
    {
        $expected = array_keys(self::parameters($operation));
        $actual = array_map(
            static fn (\ReflectionParameter $parameter): string => $parameter->getName(),
            (new \ReflectionMethod(Telegram::class, $name))->getParameters(),
        );

        sort($expected);
        sort($actual);

        $this->assertSame(
            $expected,
            $actual,
            "Telegram::{$name}() does not take exactly the fields the Bot API documents.",
        );
    }

    #[DataProvider('operationProvider')]
    public function testRequiredParametersComeFirstAndCannotBeOmitted(string $name, array $operation): void
    {
        $required = self::requiredParameters($operation);
        $parameters = (new \ReflectionMethod(Telegram::class, $name))->getParameters();

        $this->assertCount(
            count(self::parameters($operation)),
            $parameters,
            "Telegram::{$name}() takes a different number of parameters than the spec documents.",
        );

        $seenOptional = false;

        foreach ($parameters as $parameter) {
            $isRequired = in_array($parameter->getName(), $required, true);

            if ($isRequired) {
                $this->assertFalse(
                    $seenOptional,
                    "Telegram::{$name}(): the required field \${$parameter->getName()} must come before the optional ones.",
                );
                $this->assertFalse(
                    $parameter->isDefaultValueAvailable(),
                    "Telegram::{$name}(): the required field \${$parameter->getName()} must not have a default.",
                );
                $this->assertFalse(
                    $parameter->allowsNull(),
                    "Telegram::{$name}(): the required field \${$parameter->getName()} must not accept null.",
                );

                continue;
            }

            $seenOptional = true;

            $this->assertTrue(
                $parameter->isDefaultValueAvailable() && $parameter->getDefaultValue() === null,
                "Telegram::{$name}(): the optional field \${$parameter->getName()} must default to null.",
            );
        }
    }

    #[DataProvider('operationProvider')]
    public function testParameterTypesAcceptEveryDocumentedForm(string $name, array $operation): void
    {
        $parameters = self::parameters($operation);
        $required = self::requiredParameters($operation);
        $method = new \ReflectionMethod(Telegram::class, $name);

        $this->assertCount(count($parameters), $method->getParameters());

        foreach ($method->getParameters() as $parameter) {
            $schema = $parameters[$parameter->getName()];
            $expected = self::expectedTypes($schema['x-telegram-types'] ?? []);

            if (! in_array($parameter->getName(), $required, true)) {
                $expected[] = 'null';
            }

            $actual = self::typeNames($parameter->getType());

            sort($expected);
            sort($actual);

            $this->assertSame(
                array_values(array_unique($expected)),
                $actual,
                sprintf(
                    'Telegram::%s(): $%s is typed %s but the Bot API documents it as %s.',
                    $name,
                    $parameter->getName(),
                    (string) $parameter->getType(),
                    implode(' or ', $schema['x-telegram-types'] ?? []),
                ),
            );
        }
    }

    #[DataProvider('operationProvider')]
    public function testEveryParameterIsDocumented(string $name, array $operation): void
    {
        $doc = (string) (new \ReflectionMethod(Telegram::class, $name))->getDocComment();

        foreach (array_keys(self::parameters($operation)) as $field) {
            $this->assertStringContainsString(
                '$' . $field . ' ',
                $doc,
                "Telegram::{$name}() has no @param line for \${$field}.",
            );
        }

        $this->assertStringContainsString($operation['externalDocs']['url'], $doc, "Telegram::{$name}() should link to its documentation.");
    }

    /**
     * The PHP types a field's Telegram type tokens must map to.
     *
     * @param list<string> $tokens
     *
     * @return list<string>
     */
    private static function expectedTypes(array $tokens): array
    {
        $types = [];

        foreach ($tokens as $token) {
            if (str_starts_with($token, 'Array of ')) {
                $types[] = 'array';

                continue;
            }

            match ($token) {
                'Integer' => $types[] = 'int',
                'String' => $types[] = 'string',
                'Boolean', 'True' => $types[] = 'bool',
                'Float' => $types[] = 'float',
                'InputFile' => $types[] = 'Telegram\Builders\InputFile',
                default => array_push($types, 'array', 'JsonSerializable'),
            };
        }

        return $types;
    }

    /**
     * @return list<string>
     */
    private static function typeNames(?\ReflectionType $type): array
    {
        if ($type instanceof \ReflectionNamedType) {
            return $type->allowsNull() && $type->getName() !== 'null'
                ? [$type->getName(), 'null']
                : [$type->getName()];
        }

        if ($type instanceof \ReflectionUnionType) {
            return array_map(static fn (\ReflectionType $part): string => (string) $part, $type->getTypes());
        }

        return [];
    }
}
