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

use React\Promise\PromiseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Telegram\Events\Event;
use Telegram\Parts\Message;
use Telegram\Telegram;

/**
 * A {@see Telegram} client that routes slash commands - the counterpart of
 * DiscordPHP's `DiscordCommandClient`.
 *
 * ```php
 * $bot = new TelegramCommandClient(['token' => $token, 'description' => 'A helpful bot']);
 *
 * $bot->registerCommand('ping', fn (Message $message) => 'pong');
 * $bot->registerCommand('echo', fn (Message $message, array $args) => implode(' ', $args), [
 *     'description' => 'Repeats what you say',
 * ]);
 *
 * $bot->run();
 * ```
 *
 * A callback returning a string has it sent back as a reply; returning anything
 * else (a promise from a call you made yourself, say) leaves the client alone.
 * `/command@thisbot` is accepted as well as `/command`, which is how commands
 * addressed to one bot in a group are written, and a command addressed to a
 * *different* bot is ignored.
 *
 * With `register_commands` left on, the listed commands are published to
 * Telegram with `setMyCommands` on {@see Event::READY}, so they show up in the
 * client's command menu.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class TelegramCommandClient extends Telegram
{
    /** @var array<string, Command> Trigger => command, aliases included. */
    private array $commands = [];

    /** @var array<string, Command> Name => command, for listing. */
    private array $registry = [];

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $this->on(Event::MESSAGE, $this->handleMessage(...));

        if ($this->options['register_commands']) {
            $this->on(Event::READY, function (): void {
                $this->publishCommands();
            });
        }

        if ($this->options['help_command'] !== null) {
            $this->registerHelpCommand((string) $this->options['help_command']);
        }
    }

    /** Adds the command-routing options on top of the client's own. */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'prefix' => '/',
                'description' => '',
                'register_commands' => true,
                'help_command' => 'help',
                'case_insensitive' => true,
            ])
            ->setAllowedTypes('prefix', 'string')
            ->setAllowedTypes('description', 'string')
            ->setAllowedTypes('register_commands', 'bool')
            ->setAllowedTypes('help_command', ['null', 'string'])
            ->setAllowedTypes('case_insensitive', 'bool');
    }

    /**
     * Registers a command.
     *
     * @param callable(Message, list<string>, self): mixed $callback
     * @param array<string, mixed>                         $options `description`, `aliases`, `listed`.
     */
    public function registerCommand(string $name, callable $callback, array $options = []): Command
    {
        $name = $this->normalise($name);

        if (isset($this->registry[$name])) {
            throw new \InvalidArgumentException("The command {$name} is already registered.");
        }

        $command = new Command(
            $name,
            $callback(...),
            (string) ($options['description'] ?? ''),
            array_map($this->normalise(...), $options['aliases'] ?? []),
            (bool) ($options['listed'] ?? true),
        );

        $this->registry[$name] = $command;

        foreach ($command->getTriggers() as $trigger) {
            $this->commands[$trigger] = $command;
        }

        return $command;
    }

    /** Forgets a command, aliases included. */
    public function unregisterCommand(string $name): void
    {
        $name = $this->normalise($name);
        $command = $this->registry[$name] ?? null;

        if ($command === null) {
            return;
        }

        foreach ($command->getTriggers() as $trigger) {
            unset($this->commands[$trigger]);
        }

        unset($this->registry[$name]);
    }

    public function getCommand(string $name): ?Command
    {
        return $this->commands[$this->normalise($name)] ?? null;
    }

    /** @return array<string, Command> Registered commands, keyed by name. */
    public function getCommands(): array
    {
        return $this->registry;
    }

    /**
     * Publishes the listed commands to Telegram, which is what fills the command
     * menu in the client.
     *
     * @return PromiseInterface<bool>
     */
    public function publishCommands(): PromiseInterface
    {
        $commands = [];

        foreach ($this->registry as $command) {
            if ($command->isListed()) {
                $commands[] = [
                    'command' => $command->getName(),
                    'description' => $command->getDescription() !== '' ? $command->getDescription() : $command->getName(),
                ];
            }
        }

        return $this->setMyCommands($commands);
    }

    /** Routes an incoming message to a command, if it is one. */
    protected function handleMessage(Message $message): void
    {
        $text = $message->text ?? $message->caption ?? null;

        if (! is_string($text) || $text === '') {
            return;
        }

        $prefix = (string) $this->options['prefix'];

        if ($prefix !== '' && ! str_starts_with($text, $prefix)) {
            return;
        }

        $parts = preg_split('/\s+/', trim(substr($text, strlen($prefix))), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $trigger = array_shift($parts);

        if ($trigger === null) {
            return;
        }

        // "/ping@mybot" in a group is addressed to this bot; "@otherbot" is not.
        if (str_contains($trigger, '@')) {
            [$trigger, $addressee] = explode('@', $trigger, 2);
            $username = $this->getBotUser()?->username;

            if ($username !== null && strcasecmp($addressee, $username) !== 0) {
                return;
            }
        }

        $command = $this->getCommand($trigger);

        if ($command === null) {
            return;
        }

        try {
            $result = $command->handle($message, array_values($parts), $this);
        } catch (\Throwable $e) {
            $this->logger->error("Command {$trigger} threw: {$e->getMessage()}", ['exception' => $e]);
            $this->emit(Event::ERROR, [$e, $this]);

            return;
        }

        if (is_string($result) && $result !== '') {
            $message->reply($result);
        }
    }

    /** The built-in `/help`, which lists what is registered. */
    private function registerHelpCommand(string $name): void
    {
        $this->registerCommand($name, function (Message $message): string {
            $lines = [];

            if (($description = (string) $this->options['description']) !== '') {
                $lines[] = $description;
                $lines[] = '';
            }

            foreach ($this->registry as $command) {
                if ($command->isListed()) {
                    $lines[] = $this->options['prefix'] . $command->getName()
                        . ($command->getDescription() !== '' ? ' - ' . $command->getDescription() : '');
                }
            }

            return implode("\n", $lines);
        }, ['description' => 'Lists the commands this bot answers to']);
    }

    /** Commands are matched case-insensitively unless that is turned off. */
    private function normalise(string $name): string
    {
        return $this->options['case_insensitive'] ? strtolower($name) : $name;
    }
}
