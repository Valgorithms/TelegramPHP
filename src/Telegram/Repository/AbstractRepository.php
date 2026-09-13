<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Repository;

use Discord\Helpers\Collection;
use React\Promise\PromiseInterface;

use function React\Promise\resolve;

use Telegram\Parts\Part;
use Telegram\Telegram;

/**
 * An in-memory view of the parts of one kind this client has seen.
 *
 * DiscordPHP repositories are backed by list endpoints; the Bot API has none -
 * a bot learns about a chat or a user by being told about them in an update, and
 * can look one up only if it already holds an identifier. So a repository here is
 * a cache that updates fill in, with {@see fetch()} going to Telegram for a fresh
 * copy where a method for that exists.
 *
 * @template TPart of Part
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
abstract class AbstractRepository implements \Countable, \IteratorAggregate
{
    /**
     * The part class this repository holds.
     *
     * @var class-string<TPart>
     */
    protected string $part;

    /** The attribute that identifies a row. */
    protected string $discrim = 'id';

    /** @var Collection<TPart> */
    protected Collection $items;

    public function __construct(protected readonly Telegram $telegram)
    {
        $this->items = new Collection([], $this->discrim, null);
    }

    /**
     * Remembers a part, or merges it into the one already held under that id.
     *
     * @param TPart $part
     *
     * @return TPart The cached part - the merged one when an entry already existed.
     */
    public function cache(Part $part): Part
    {
        $id = $part->{$this->discrim};

        if ($id === null) {
            return $part;
        }

        $existing = $this->items->get($this->discrim, self::normalise($id));

        if ($existing instanceof Part && $existing::class === $part::class) {
            $existing->fill($part->getRawAttributes());

            return $existing;
        }

        if ($existing instanceof Part) {
            // A richer record for the same id - a ChatFullInfo over the Chat stub
            // an update brought in. The new one wins, but anything only the stub
            // knew is carried across rather than dropped.
            foreach ($existing->getRawAttributes() as $key => $value) {
                if (! $part->attributeExists($key)) {
                    $part->setAttribute($key, $value);
                }
            }
        }

        $this->items->pushItem($part);

        return $part;
    }

    /**
     * The cached part with this id, if it has been seen.
     *
     * @return TPart|null
     */
    public function get(int|string $id): ?Part
    {
        return $this->items->get($this->discrim, self::normalise($id));
    }

    /**
     * Telegram ids are integers, but they arrive as strings often enough - out of
     * a config file, off a command argument - that a lookup has to accept both.
     * A `@channelusername` is left alone; it is not an id at all.
     */
    protected static function normalise(int|string $id): int|string
    {
        return is_string($id) && ctype_digit(ltrim($id, '-')) ? (int) $id : $id;
    }

    public function has(int|string $id): bool
    {
        return $this->get($id) !== null;
    }

    /**
     * The cached part if there is one, otherwise a fresh copy from Telegram.
     *
     * @return PromiseInterface<TPart>
     */
    public function fetchOrGet(int|string $id): PromiseInterface
    {
        $cached = $this->get($id);

        return $cached !== null ? resolve($cached) : $this->fetch($id);
    }

    /**
     * A fresh copy from Telegram, cached on the way back.
     *
     * @return PromiseInterface<TPart>
     */
    abstract public function fetch(int|string $id): PromiseInterface;

    /** @return Collection<TPart> */
    public function all(): Collection
    {
        return $this->items;
    }

    public function clear(): void
    {
        $this->items = new Collection([], $this->discrim, null);
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function getIterator(): \Traversable
    {
        return $this->items->getIterator();
    }
}
