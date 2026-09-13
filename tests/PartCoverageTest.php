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

use Discord\Helpers\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use Telegram\Factory\Factory;
use Telegram\Parts\Part;

/**
 * Every Bot API object the spec describes has a part, that part accepts every
 * field the object has, and the unions resolve to the right member.
 */
final class PartCoverageTest extends SpecTestCase
{
    #[DataProvider('schemaProvider')]
    public function testEveryTypeHasAPart(string $name, array $schema): void
    {
        $class = Factory::PART_NAMESPACE . $name;

        $this->assertTrue(class_exists($class), "There is no part for the Bot API type {$name}.");
        $this->assertTrue(is_subclass_of($class, Part::class), "{$class} must extend Part.");
    }

    #[DataProvider('schemaProvider')]
    public function testPartsAcceptEveryDocumentedField(string $name, array $schema): void
    {
        if (isset($schema['x-telegram-subtypes'])) {
            $this->assertTrue(
                (new \ReflectionClass(Factory::PART_NAMESPACE . $name))->isAbstract(),
                "{$name} is a union of other types, so its part must be abstract.",
            );

            return;
        }

        $part = (new \ReflectionClass(Factory::PART_NAMESPACE . $name))->newInstanceWithoutConstructor();

        $this->assertSame(
            array_keys($schema['properties'] ?? []),
            $part->getFillable(),
            "{$name} does not accept exactly the fields the Bot API documents, in order.",
        );
    }

    #[DataProvider('schemaProvider')]
    public function testCastsPointAtRealTypes(string $name, array $schema): void
    {
        if (isset($schema['x-telegram-subtypes'])) {
            $this->assertNotEmpty(
                (Factory::PART_NAMESPACE . $name)::SUBTYPES,
                "{$name} is a union and must list its subtypes.",
            );

            return;
        }

        $part = (new \ReflectionClass(Factory::PART_NAMESPACE . $name))->newInstanceWithoutConstructor();
        $factory = $this->client()->getFactory();

        $this->assertIsArray($part->getCasts(), "{$name} must declare its casts as an array.");

        foreach ($part->getCasts() as $field => $token) {
            $this->assertContains($field, $part->getFillable(), "{$name}: \${$field} is cast but not fillable.");

            $inner = $token;
            while (str_starts_with($inner, 'Array of ')) {
                $inner = substr($inner, strlen('Array of '));
            }

            $this->assertTrue(
                $factory->partClassFor($inner) !== null
                    || in_array($inner, ['Integer', 'String', 'Boolean', 'Float', 'True', 'InputFile'], true),
                "{$name}: \${$field} is cast to {$token}, which is neither a part nor a primitive.",
            );
        }
    }

    #[DataProvider('schemaProvider')]
    public function testEveryFieldSurvivesHydrationAndSerialisation(string $name, array $schema): void
    {
        if (isset($schema['x-telegram-subtypes'])) {
            $this->assertTrue(true, 'Unions are covered by their members.');

            return;
        }

        $attributes = [];
        foreach ($schema['properties'] ?? [] as $field => $property) {
            $attributes[$field] = self::sampleFor($property['x-telegram-types'] ?? ['String']);
        }

        if ($attributes === []) {
            $this->assertSame([], $attributes, "{$name} has no fields.");

            return;
        }

        $part = $this->client()->getFactory()->part(Factory::PART_NAMESPACE . $name, $attributes);

        foreach (array_keys($attributes) as $field) {
            $this->assertTrue($part->attributeExists($field), "{$name}: \${$field} was dropped on the way in.");
        }

        $this->assertSame(
            array_keys($attributes),
            array_keys($part->jsonSerialize()),
            "{$name} does not serialise back to the fields it was built from.",
        );
    }

    #[DataProvider('schemaProvider')]
    public function testTaggedUnionsResolveToTheirMembers(string $name, array $schema): void
    {
        if (! isset($schema['discriminator'])) {
            $this->assertTrue(true, "{$name} is not a tagged union.");

            return;
        }

        $class = Factory::PART_NAMESPACE . $name;
        $property = $schema['discriminator']['propertyName'];

        $this->assertSame($property, $class::DISCRIMINATOR, "{$name} must resolve on its documented discriminator.");

        $factory = $this->client()->getFactory();

        foreach ($schema['discriminator']['mapping'] as $value => $ref) {
            $expected = Factory::PART_NAMESPACE . basename($ref);
            $resolved = $factory->part($class, [$property => $value]);

            $this->assertInstanceOf(
                $expected,
                $resolved,
                "{$name} with {$property}=\"{$value}\" should build a " . basename($ref) . '.',
            );
        }
    }

    public function testUntaggedUnionsResolveByShape(): void
    {
        $factory = $this->client()->getFactory();

        $accessible = $factory->create('MaybeInaccessibleMessage', [
            'message_id' => 1,
            'date' => 1700000000,
            'chat' => ['id' => 5, 'type' => 'private'],
        ]);
        $inaccessible = $factory->create('MaybeInaccessibleMessage', [
            'message_id' => 1,
            'date' => 0,
            'chat' => ['id' => 5, 'type' => 'private'],
        ]);

        $this->assertInstanceOf(\Telegram\Parts\Message::class, $accessible);
        $this->assertInstanceOf(\Telegram\Parts\InaccessibleMessage::class, $inaccessible);
    }

    public function testArraysOfPartsBecomeCollections(): void
    {
        $factory = $this->client()->getFactory();

        $updates = $factory->create('Array of Update', [
            ['update_id' => 1, 'message' => ['message_id' => 1, 'date' => 1, 'chat' => ['id' => 1, 'type' => 'private']]],
            ['update_id' => 2],
        ]);

        $this->assertInstanceOf(Collection::class, $updates);
        $this->assertCount(2, $updates);
        $this->assertInstanceOf(\Telegram\Parts\Update::class, $updates->first());
        $this->assertInstanceOf(\Telegram\Parts\Message::class, $updates->first()->message);
    }

    public function testEveryBehaviourTraitBelongsToAPart(): void
    {
        $traits = glob(dirname(__DIR__) . '/src/Telegram/Parts/Concerns/*Behaviour.php');

        $this->assertNotEmpty($traits, 'The behaviour traits are missing.');

        foreach ($traits as $file) {
            $type = substr(basename($file, '.php'), 0, -strlen('Behaviour'));
            $class = Factory::PART_NAMESPACE . $type;

            $this->assertTrue(class_exists($class), "{$type}Behaviour has no part to belong to.");
            $this->assertContains(
                'Telegram\Parts\Concerns\\' . $type . 'Behaviour',
                self::traitsOf($class),
                "{$class} does not use its {$type}Behaviour trait - re-run `composer spec:generate`.",
            );
        }
    }

    /** @return list<string> Traits used by a class or anything it extends. */
    private static function traitsOf(string $class): array
    {
        $traits = [];

        for ($reflection = new \ReflectionClass($class); $reflection !== false; $reflection = $reflection->getParentClass()) {
            foreach ($reflection->getTraitNames() as $trait) {
                $traits[] = $trait;
            }
        }

        return $traits;
    }

    /**
     * @param list<string> $tokens
     */
    private static function sampleFor(array $tokens, int $depth = 0): mixed
    {
        $token = $tokens[0];

        if (str_starts_with($token, 'Array of ')) {
            return [self::sampleFor([substr($token, strlen('Array of '))], $depth)];
        }

        return match ($token) {
            'Integer' => 7,
            'Float' => 2.5,
            'Boolean', 'True' => true,
            'String' => 'value',
            'InputFile' => 'file-id',
            default => self::sampleObjectFor($token, $depth),
        };
    }

    /**
     * A payload for a nested object: its required fields, and - for a union - the
     * tag that picks a member. Recursion stops a few levels down, which is deep
     * enough for every object the Bot API nests and shallow enough to terminate on
     * the ones that nest themselves.
     *
     * @return array<string, mixed>
     */
    private static function sampleObjectFor(string $type, int $depth = 0): array
    {
        $schema = self::schemas()[$type] ?? null;

        if ($schema === null || $depth > 3) {
            return [];
        }

        if (isset($schema['discriminator'])) {
            $mapping = $schema['discriminator']['mapping'];
            $member = basename((string) reset($mapping));

            return [$schema['discriminator']['propertyName'] => (string) array_key_first($mapping)]
                + self::sampleObjectFor($member, $depth + 1);
        }

        if (isset($schema['x-telegram-subtypes'])) {
            $members = array_values(array_filter(
                $schema['x-telegram-subtypes'],
                static fn (string $member): bool => isset(self::schemas()[$member]),
            ));

            return $members === [] ? [] : self::sampleObjectFor($members[0], $depth + 1);
        }

        $attributes = [];
        foreach ($schema['required'] ?? [] as $field) {
            $attributes[$field] = self::sampleFor(
                $schema['properties'][$field]['x-telegram-types'] ?? ['String'],
                $depth + 1,
            );
        }

        return $attributes;
    }
}
