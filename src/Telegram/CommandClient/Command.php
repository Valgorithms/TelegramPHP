<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\CommandClient;

use Telegram\Parts\Message;

/**
 * One registered command: its name, what it answers to, and what it does.
 *
 * The callback is handed the {@see Message} that triggered it, the arguments
 * after the command word, and the client - and may return a string, which the
 * client sends back as a reply.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
final class Command
{
    /**
     * @param \Closure(Message, list<string>, TelegramCommandClient): mixed $callback
     * @param list<string>                                                 $aliases
     */
    public function __construct(
        private readonly string $name,
        private readonly \Closure $callback,
        private readonly string $description = '',
        private readonly array $aliases = [],
        private readonly bool $listed = true,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /** @return list<string> */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /** Whether the command belongs in the menu `setMyCommands` publishes. */
    public function isListed(): bool
    {
        return $this->listed;
    }

    /** Every word this command answers to. */
    public function getTriggers(): array
    {
        return [$this->name, ...$this->aliases];
    }

    /**
     * Runs the command.
     *
     * @param list<string> $args
     */
    public function handle(Message $message, array $args, TelegramCommandClient $client): mixed
    {
        return ($this->callback)($message, $args, $client);
    }
}
