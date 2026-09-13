<?php

/*
 * A command bot: /ping, /echo, /whoami, and the built-in /help. The listed
 * commands are published to Telegram on startup, so they appear in the menu.
 *
 *   TELEGRAM_TOKEN=123:ABC php examples/commands.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Telegram\Builders\InlineKeyboard;
use Telegram\CommandClient\TelegramCommandClient;
use Telegram\Events\Event;
use Telegram\Parts\CallbackQuery;
use Telegram\Parts\Message;

$bot = new TelegramCommandClient([
    'token' => getenv('TELEGRAM_TOKEN') ?: throw new RuntimeException('Set TELEGRAM_TOKEN.'),
    'description' => 'An example bot built with TelegramPHP',
]);

$bot->registerCommand('ping', fn (): string => 'pong', [
    'description' => 'Checks the bot is alive',
]);

$bot->registerCommand('echo', fn (Message $message, array $args): string => $args === []
    ? 'Give me something to repeat.'
    : implode(' ', $args), [
    'description' => 'Repeats what you say',
    'aliases' => ['say'],
]);

$bot->registerCommand('whoami', function (Message $message): string {
    $user = $message->from;

    return sprintf('%s (id %d)', $user?->getFullName() ?? 'someone', $user?->id ?? 0);
}, ['description' => 'Tells you who Telegram says you are']);

$bot->registerCommand('deploy', function (Message $message): void {
    $message->reply('Ready when you are.', ['reply_markup' => InlineKeyboard::new()
        ->callback('Ship it', 'deploy:yes')
        ->callback('Hold', 'deploy:no')]);
}, ['description' => 'Asks for confirmation, then answers the button']);

$bot->on(Event::CALLBACK_QUERY, function (CallbackQuery $query): void {
    [, $answer] = explode(':', (string) $query->data, 2) + [1 => 'no'];

    $query->answer($answer === 'yes' ? 'Deploying' : 'Left alone');
    $query->editMessage($answer === 'yes' ? 'Deployed. 🚀' : 'Nothing was deployed.');
});

$bot->run();
