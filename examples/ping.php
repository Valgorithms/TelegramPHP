<?php

/*
 * A minimal bot: answers "ping" with "pong", over long polling.
 *
 *   TELEGRAM_TOKEN=123:ABC php examples/ping.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Telegram\Events\Event;
use Telegram\Parts\Message;
use Telegram\Telegram;

$logger = new Logger('telegram');
$logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO));

$telegram = new Telegram([
    'token' => getenv('TELEGRAM_TOKEN') ?: throw new RuntimeException('Set TELEGRAM_TOKEN.'),
    'logger' => $logger,
    // Windows PHP usually ships without a CA bundle:
    // 'socket_options' => ['tls' => ['cafile' => 'C:/php/cacert.pem']],
]);

$telegram->on(Event::READY, function (Telegram $telegram): void {
    echo 'Logged in as @', $telegram->getBotUser()->username, PHP_EOL;
});

$telegram->on(Event::MESSAGE, function (Message $message): void {
    echo $message->from?->getHandle(), ' in ', $message->chat->id, ': ', $message->text, PHP_EOL;

    if (strtolower((string) $message->text) === 'ping') {
        $message->reply('pong');
    }
});

$telegram->on(Event::ERROR, function (Throwable $e): void {
    echo 'error: ', $e->getMessage(), PHP_EOL;
});

$telegram->run();
