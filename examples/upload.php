<?php

/*
 * Sending and receiving files: replies to any photo with a caption, and sends a
 * generated text file back.
 *
 *   TELEGRAM_TOKEN=123:ABC php examples/upload.php
 */

require __DIR__ . '/bootstrap.php';

use Telegram\Builders\InputFile;
use Telegram\Events\Event;
use Telegram\Parts\File;
use Telegram\Parts\Message;
use Telegram\Telegram;

$telegram = new Telegram([
    'token' => bot_token(),
    'socket_options' => socket_options(),
]);

$telegram->on(Event::MESSAGE, function (Message $message) use ($telegram): void {
    if ($message->photo === null) {
        return;
    }

    // Telegram sends every size it made; the last one is the largest.
    $largest = $message->photo->last();

    $telegram->getFile($largest->file_id)
        ->then(fn (File $file) => $file->download())
        ->then(function (string $bytes) use ($message): void {
            $message->reply(sprintf('Got %d bytes.', strlen($bytes)));

            $message->replyWithDocument(
                InputFile::fromString('Received ' . strlen($bytes) . " bytes\n", 'receipt.txt', 'text/plain'),
                ['caption' => 'Your receipt'],
            );
        }, function (Throwable $e) use ($message): void {
            $message->reply('Could not read that: ' . $e->getMessage());
        });
});

$telegram->run();
