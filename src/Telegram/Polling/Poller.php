<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Polling;

use Discord\Helpers\Collection;
use Telegram\Events\Event;
use Telegram\Http\Exceptions\ConflictException;
use Telegram\Http\Exceptions\HttpException;
use Telegram\Parts\Update;
use Telegram\Telegram;

/**
 * Long polling: the update source a bot uses when it has no public HTTPS address.
 *
 * Each round calls `getUpdates` with a `timeout`, so the connection is held open
 * until Telegram has something to say or the timeout expires. Updates are handed
 * to {@see Telegram::handleUpdate()} and the offset advances past the highest
 * `update_id` seen, which is what acknowledges them. A failed round backs off
 * before the next one rather than hammering a server that is already unhappy.
 *
 * @link https://core.telegram.org/bots/api#getupdates
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Poller
{
    /** Longest back-off between failed rounds, in seconds. */
    private const MAX_BACKOFF = 30.0;

    private bool $running = false;

    private ?int $offset = null;

    private float $backoff = 1.0;

    /** Set while a round is in flight, so {@see stop()} can ignore its result. */
    private int $generation = 0;

    /**
     * @param list<string>|null $allowedUpdates Update types to receive; null keeps Telegram's default.
     */
    public function __construct(
        private readonly Telegram $telegram,
        private readonly int $timeout = 50,
        private readonly int $limit = 100,
        private readonly ?array $allowedUpdates = null,
        private readonly bool $dropPendingUpdates = false,
    ) {
    }

    public function start(): void
    {
        if ($this->running) {
            return;
        }

        $this->running = true;
        ++$this->generation;

        if ($this->dropPendingUpdates) {
            // -1 asks for the last update only; acknowledging it drops the backlog.
            $this->offset = -1;
        }

        $this->poll($this->generation);
    }

    public function stop(): void
    {
        $this->running = false;
        ++$this->generation;
    }

    public function isRunning(): bool
    {
        return $this->running;
    }

    /** The `update_id` the next round will ask from. */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    private function poll(int $generation): void
    {
        if (! $this->running || $generation !== $this->generation) {
            return;
        }

        $this->telegram->getUpdates(
            offset: $this->offset,
            limit: $this->limit,
            timeout: $this->timeout,
            allowed_updates: $this->allowedUpdates,
        )->then(
            function (Collection|array $updates) use ($generation): void {
                $this->backoff = 1.0;
                $this->dispatch($updates);

                // Queue the next round rather than calling straight into it: a
                // transport that answers synchronously would otherwise recurse
                // until the stack ran out.
                $this->telegram->getLoop()->futureTick(function () use ($generation): void {
                    $this->poll($generation);
                });
            },
            function (\Throwable $e) use ($generation): void {
                $this->handleFailure($e, $generation);
            },
        );
    }

    /**
     * @param Collection<Update>|list<Update> $updates
     */
    private function dispatch(Collection|array $updates): void
    {
        foreach ($updates as $update) {
            if (! $update instanceof Update) {
                continue;
            }

            $this->offset = max($this->offset ?? 0, (int) $update->update_id + 1);

            try {
                $this->telegram->handleUpdate($update);
            } catch (\Throwable $e) {
                // One malformed or mishandled update must not end the loop.
                $this->telegram->getLogger()->error('Update handler threw: ' . $e->getMessage(), ['exception' => $e]);
                $this->telegram->emit(Event::ERROR, [$e, $this->telegram]);
            }
        }
    }

    private function handleFailure(\Throwable $e, int $generation): void
    {
        if (! $this->running || $generation !== $this->generation) {
            return;
        }

        $logger = $this->telegram->getLogger();

        if ($e instanceof ConflictException) {
            // Another poller, or a webhook, owns this token's updates.
            $logger->error('getUpdates conflict: ' . $e->getMessage());
        } else {
            $logger->warning('getUpdates failed: ' . $e->getMessage());
        }

        $this->telegram->emit(Event::ERROR, [$e, $this->telegram]);

        $wait = $e instanceof HttpException && $e->getRetryAfter() !== null
            ? (float) $e->getRetryAfter()
            : $this->backoff;

        $this->backoff = min($this->backoff * 2, self::MAX_BACKOFF);

        $this->telegram->getLoop()->addTimer($wait, function () use ($generation): void {
            $this->poll($generation);
        });
    }
}
