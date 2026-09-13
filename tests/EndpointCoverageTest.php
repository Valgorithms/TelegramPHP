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
use Telegram\Events\Event;
use Telegram\Http\Endpoint;
use Telegram\Telegram;

/**
 * Every Bot API method the spec describes is reachable from the client, and the
 * client exposes nothing the spec does not describe.
 */
final class EndpointCoverageTest extends SpecTestCase
{
    #[DataProvider('operationProvider')]
    public function testClientHasAMethodForEveryOperation(string $name, array $operation): void
    {
        $this->assertTrue(
            method_exists(Telegram::class, $name),
            "Telegram has no method for the Bot API method {$name}.",
        );

        $method = new \ReflectionMethod(Telegram::class, $name);

        $this->assertTrue($method->isPublic(), "Telegram::{$name}() must be public.");
        $this->assertSame($name, $method->getName(), 'The method name must match the Bot API name exactly.');
        $this->assertSame(
            'React\Promise\PromiseInterface',
            (string) $method->getReturnType(),
            "Telegram::{$name}() must return a promise.",
        );
    }

    #[DataProvider('operationProvider')]
    public function testNoHandWrittenMethodShadowsAGeneratedOne(string $name, array $operation): void
    {
        // A method declared on the client itself silently wins over the one a
        // trait brings in, which would leave a Bot API method unreachable - the
        // Bot API's own `close` against a client-side `close()`, for one. Only
        // the generated methods carry a link to the Bot API reference, so that
        // link is what tells the two apart.
        $doc = (string) (new \ReflectionMethod(Telegram::class, $name))->getDocComment();

        $this->assertStringContainsString(
            'core.telegram.org/bots/api#',
            $doc,
            "Telegram::{$name}() is not the generated Bot API method - a hand-written method of the same name shadows it.",
        );
    }

    #[DataProvider('operationProvider')]
    public function testEveryOperationHasAnEndpointConstant(string $name, array $operation): void
    {
        $this->assertContains(
            $name,
            Endpoint::all(),
            "Endpoint has no constant for the Bot API method {$name}.",
        );
    }

    public function testEndpointConstantsMatchTheSpecExactly(): void
    {
        $expected = array_keys(self::operations());
        $actual = Endpoint::all();

        sort($expected);
        sort($actual);

        $this->assertSame($expected, $actual, 'Endpoint must list every Bot API method, and nothing else.');
    }

    public function testTheClientExposesNoMethodOutsideTheSpec(): void
    {
        $operations = self::operations();
        $generated = [];

        foreach ((new \ReflectionClass(Telegram::class))->getTraits() as $trait) {
            if ($trait->getName() !== 'Telegram\Api\Methods') {
                continue;
            }

            foreach ($trait->getTraits() as $group) {
                foreach ($group->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                    $generated[] = $method->getName();
                }
            }
        }

        $this->assertNotEmpty($generated, 'No generated API traits were found on the client.');

        foreach ($generated as $method) {
            $this->assertArrayHasKey(
                $method,
                $operations,
                "Telegram::{$method}() is generated but the spec describes no such Bot API method.",
            );
        }

        $this->assertCount(
            count($operations),
            array_unique($generated),
            'Every Bot API method should be generated exactly once.',
        );
    }

    public function testUpdateEventsMatchTheUpdateType(): void
    {
        $expected = array_values(array_filter(
            array_keys(self::schemas()['Update']['properties']),
            static fn (string $field): bool => $field !== 'update_id',
        ));

        $this->assertSame($expected, Event::all(), 'Event must list every update type in the Update object.');

        foreach ($expected as $type) {
            $constant = strtoupper($type);

            $this->assertTrue(
                \defined(Event::class . '::' . $constant),
                "Event::{$constant} is missing for the update type {$type}.",
            );
            $this->assertSame($type, \constant(Event::class . '::' . $constant));
            $this->assertArrayHasKey($type, Event::PAYLOAD_TYPES);
        }
    }

    public function testPayloadTypesNameRealParts(): void
    {
        $client = $this->client();

        foreach (Event::PAYLOAD_TYPES as $type => $token) {
            $this->assertNotNull(
                $client->getFactory()->partClassFor($token),
                "The update type {$type} claims to carry a {$token}, which is not a part.",
            );
        }
    }

    public function testTheBundledSpecVersionIsTheOneTheClientAdvertises(): void
    {
        $this->assertSame(
            self::document()['info']['version'],
            Telegram::BOT_API_VERSION,
            'Telegram::BOT_API_VERSION must match the spec the library was generated from.',
        );
    }
}
