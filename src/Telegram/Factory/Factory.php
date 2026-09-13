<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Factory;

use Discord\Helpers\Collection;
use Telegram\Exceptions\PartException;
use Telegram\Parts\Part;
use Telegram\Telegram;

/**
 * Builds {@see Part}s from raw Bot API payloads.
 *
 * The unit of work is a Telegram *type token* - the same strings the spec uses:
 * `"Message"`, `"Array of Update"`, `"Integer"`, `"Boolean"`. Generated parts
 * declare them in `$casts` and generated API methods declare them as their return
 * type, so one hydrator covers nested objects and call results alike.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Factory
{
    /** Where generated parts live. */
    public const PART_NAMESPACE = 'Telegram\\Parts\\';

    public function __construct(private readonly Telegram $telegram)
    {
    }

    /**
     * Hydrates a value according to its Telegram type token.
     *
     * Scalars pass through untouched, `Array of X` becomes a {@see Collection} of
     * hydrated members, and an object type becomes the matching part - resolving
     * to a concrete subtype when the token names a union.
     */
    public function create(string $token, mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }

        if (str_starts_with($token, 'Array of ')) {
            if (! is_array($value)) {
                return $value;
            }

            $inner = substr($token, strlen('Array of '));
            $items = array_map(fn ($item): mixed => $this->create($inner, $item), $value);

            $class = $this->partClassFor($inner);

            return $class === null
                ? $items
                : new Collection(array_values($items), null, $class);
        }

        $class = $this->partClassFor($token);

        if ($value instanceof Part) {
            // Already hydrated - re-wrapping it would lose everything, because a
            // part's attributes live behind its accessors, not on the object.
            return $class === null || $value instanceof $class
                ? $value
                : $this->part($class, $value->jsonSerialize());
        }

        if ($class === null || ! is_array($value) && ! is_object($value)) {
            // A scalar token (Integer, String, Boolean), or a union member that
            // arrived as a scalar - RichText, for one, may simply be a string.
            return $value;
        }

        return $this->part($class, (array) $value);
    }

    /**
     * Builds one part, resolving a union parent to the concrete subtype the
     * payload describes.
     *
     * @param class-string<Part>   $class
     * @param array<string, mixed> $attributes
     *
     * @throws PartException When the class does not exist or a union cannot be resolved.
     */
    public function part(string $class, array $attributes = []): Part
    {
        if (! class_exists($class)) {
            throw new PartException("Unknown part class {$class}.");
        }

        if ($class::SUBTYPES !== []) {
            $class = $class::resolveSubtype($attributes);
        }

        if ((new \ReflectionClass($class))->isAbstract()) {
            throw new PartException("Cannot instantiate abstract part {$class}.");
        }

        return new $class($this->telegram, $attributes);
    }

    /**
     * The part class a Telegram type name maps to, or null when the token is a
     * primitive ("Integer", "String", "Boolean", "Float", "InputFile").
     *
     * @return class-string<Part>|null
     */
    public function partClassFor(string $type): ?string
    {
        $class = self::PART_NAMESPACE . $type;

        return class_exists($class) && is_subclass_of($class, Part::class) ? $class : null;
    }

    public function getTelegram(): Telegram
    {
        return $this->telegram;
    }
}
