<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts;

use Carbon\CarbonImmutable;
use Telegram\Exceptions\PartException;
use Telegram\Factory\Factory;
use Telegram\Telegram;

/**
 * Base model for one Bot API object.
 *
 * Mirrors DiscordPHP's `Part`: a `$fillable` allow-list, `get{Attr}Attribute` /
 * `set{Attr}Attribute` mutator hooks, property and array access, and JSON
 * serialisation. Sub-classes under `Parts/` are generated from the OpenAPI
 * document and declare only data - `$fillable`, `$casts` (attribute to Telegram
 * type, used to hydrate nested parts) and `$dates` - so behaviour lives in the
 * hand-written traits under `Parts/Concerns`, which the generator mixes back in.
 *
 * Union types (`ChatMember`, `InputMedia`, ...) are generated as abstract parts
 * carrying {@see DISCRIMINATOR} and {@see SUBTYPES}; {@see resolveSubtype()}
 * picks the concrete class an incoming payload belongs to.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
abstract class Part implements \ArrayAccess, \JsonSerializable
{
    /**
     * The attribute whose value names the concrete subtype, for union parents.
     * `null` on ordinary parts and on unions Telegram does not tag.
     */
    public const DISCRIMINATOR = null;

    /**
     * The concrete classes a union parent may resolve to - keyed by discriminator
     * value when there is one, a plain list otherwise. Empty on ordinary parts.
     *
     * @var array<string, class-string<Part>>|list<class-string<Part>>
     */
    public const SUBTYPES = [];

    /**
     * Attribute names this part accepts. Empty = accept anything.
     *
     * @var list<string>
     */
    protected array $fillable = [];

    /**
     * Attribute name => Telegram type token ("User", "Array of PhotoSize"), used
     * to hydrate nested objects into parts.
     *
     * @var array<string, string>
     */
    protected array $casts = [];

    /**
     * Attribute names holding Unix timestamps, read back as {@see CarbonImmutable}.
     *
     * @var list<string>
     */
    protected array $dates = [];

    /** @var array<string, mixed> */
    private array $attributes = [];

    /**
     * @param array<string, mixed>|object $attributes
     */
    public function __construct(
        protected readonly Telegram $telegram,
        array|object $attributes = [],
    ) {
        $this->fill((array) $attributes);
    }

    /**
     * @param array<string, mixed> $attributes
     */
    public function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if ($this->fillable === [] || in_array($key, $this->fillable, true)) {
                $this->setAttribute((string) $key, $value);
            }
        }
    }

    public function setAttribute(string $key, mixed $value): void
    {
        $setter = 'set' . self::studly($key) . 'Attribute';
        if (method_exists($this, $setter)) {
            $this->{$setter}($value);

            return;
        }

        if ($value !== null && isset($this->casts[$key])) {
            $value = $this->factory()->create($this->casts[$key], $value);
        }

        $this->attributes[$key] = $value;
    }

    public function getAttribute(string $key): mixed
    {
        $getter = 'get' . self::studly($key) . 'Attribute';
        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        $value = $this->attributes[$key] ?? null;

        if ($value !== null && is_int($value) && in_array($key, $this->dates, true)) {
            return CarbonImmutable::createFromTimestampUTC($value);
        }

        return $value;
    }

    /**
     * Writes straight to the attribute bag, skipping the `set{Key}Attribute` hook
     * and any cast. For use *inside* a mutator, which would otherwise have no way
     * to store its shaped value without recursing through {@see setAttribute()}.
     */
    protected function setRawAttribute(string $key, mixed $value): void
    {
        $this->attributes[$key] = $value;
    }

    /** Reads straight from the attribute bag, skipping the `get{Key}Attribute` hook. */
    protected function getRawAttribute(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    public function attributeExists(string $key): bool
    {
        return array_key_exists($key, $this->attributes)
            || method_exists($this, 'get' . self::studly($key) . 'Attribute');
    }

    /** @return array<string, mixed> */
    public function getRawAttributes(): array
    {
        return $this->attributes;
    }

    /** @return list<string> */
    public function getFillable(): array
    {
        return $this->fillable;
    }

    /** @return array<string, string> */
    public function getCasts(): array
    {
        return $this->casts;
    }

    public function getTelegram(): Telegram
    {
        return $this->telegram;
    }

    /** Builds another part from the same client - for nested objects. */
    protected function factory(): Factory
    {
        return $this->telegram->getFactory();
    }

    /**
     * The concrete class an incoming payload belongs to, for a union parent.
     *
     * Tagged unions resolve on their discriminator. The handful Telegram leaves
     * untagged (`InputMessageContent`, and the rest), and any payload whose tag
     * this build does not recognise - a member added to the Bot API since it was
     * generated - resolve instead to the subtype whose attributes the payload
     * matches most closely.
     *
     * @param array<string, mixed> $attributes
     *
     * @return class-string<Part>
     *
     * @throws PartException When the part is not a union, or nothing matches.
     */
    public static function resolveSubtype(array $attributes): string
    {
        $subtypes = static::SUBTYPES;

        if ($subtypes === []) {
            throw new PartException(static::class . ' is not a union type and has no subtypes to resolve.');
        }

        $discriminator = static::DISCRIMINATOR;

        if ($discriminator !== null) {
            $value = $attributes[$discriminator] ?? null;

            if (is_string($value) && isset($subtypes[$value])) {
                return $subtypes[$value];
            }

            // An unknown tag means Telegram has added a member since this build
            // was generated. Fall through to matching on shape rather than
            // failing the whole update over one unfamiliar payload.
            $subtypes = array_values($subtypes);
        }

        $best = null;
        $bestScore = -1;

        foreach ($subtypes as $subtype) {
            /** @var Part $prototype */
            $prototype = (new \ReflectionClass($subtype))->newInstanceWithoutConstructor();
            $fillable = $prototype->getFillable();
            $known = array_intersect(array_keys($attributes), $fillable);
            $unknown = array_diff(array_keys($attributes), $fillable);
            $score = count($known) - count($unknown);

            if ($score > $bestScore) {
                $best = $subtype;
                $bestScore = $score;
            }
        }

        if ($best === null) {
            throw new PartException(static::class . ': no subtype matches the payload.');
        }

        return $best;
    }

    public function __get(string $name): mixed
    {
        return $this->getAttribute($name);
    }

    public function __set(string $name, mixed $value): void
    {
        $this->setAttribute($name, $value);
    }

    public function __isset(string $name): bool
    {
        return $this->getAttribute($name) !== null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->attributeExists((string) $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getAttribute((string) $offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setAttribute((string) $offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[(string) $offset]);
    }

    /**
     * The payload this part would be sent back to Telegram as - nested parts and
     * collections flattened, timestamps left as the integers they arrived as.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $out = [];

        foreach ($this->attributes as $key => $value) {
            $out[$key] = self::serialize($value);
        }

        return $out;
    }

    private static function serialize(mixed $value): mixed
    {
        if ($value instanceof CarbonImmutable) {
            return $value->getTimestamp();
        }

        if ($value instanceof \JsonSerializable) {
            return $value->jsonSerialize();
        }

        if ($value instanceof \Traversable) {
            $value = iterator_to_array($value);
        }

        if (is_array($value)) {
            return array_map(self::serialize(...), $value);
        }

        return $value;
    }

    /** @return array<string, mixed> */
    public function __debugInfo(): array
    {
        return $this->jsonSerialize();
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}';
    }

    private static function studly(string $value): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }
}
