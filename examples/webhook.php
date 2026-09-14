<?php

/*
 * The webhook side: listens for deliveries instead of polling. Telegram needs an
 * HTTPS endpoint, so this expects a reverse proxy in front of it terminating TLS
 * and forwarding to TELEGRAM_WEBHOOK_LISTEN.
 *
 *   TELEGRAM_TOKEN=123:ABC TELEGRAM_WEBHOOK_URL=https://bot.example.com/hook \
 *   TELEGRAM_WEBHOOK_SECRET=change-me php examples/webhook.php
 */

require __DIR__ . '/bootstrap.php';

use Telegram\Events\Event;
use Telegram\Parts\Message;
use Telegram\Telegram;

$secret = getenv('TELEGRAM_WEBHOOK_SECRET') ?: 'change-me';
$url = getenv('TELEGRAM_WEBHOOK_URL') ?: throw new RuntimeException('Set TELEGRAM_WEBHOOK_URL.');

$telegram = new Telegram([
    'token' => bot_token(),
    'socket_options' => socket_options(),
    'webhook' => [
        'listen' => getenv('TELEGRAM_WEBHOOK_LISTEN') ?: '0.0.0.0:8080',
        'path' => parse_url($url, PHP_URL_PATH) ?: '/',
        'secret_token' => $secret,
    ],
]);

$telegram->on(Event::READY, function (Telegram $telegram) use ($url, $secret): void {
    // Register the endpoint with Telegram once the listener is up.
    $telegram->setWebhook($url, secret_token: $secret, allowed_updates: [Event::MESSAGE])
        ->then(fn () => print("Webhook registered at {$url}\n"));
});

$telegram->on(Event::MESSAGE, function (Message $message): void {
    $message->reply('Delivered by webhook.');
});

$telegram->run();
