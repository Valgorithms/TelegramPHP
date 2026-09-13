<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Tests;

use PHPUnit\Framework\TestCase;
use Telegram\Builders\InlineKeyboard;
use Telegram\Builders\InputFile;
use Telegram\Builders\ReplyKeyboard;
use Telegram\Exceptions\FileNotFoundException;

/**
 * The builders: keyboards serialise to the markup Telegram documents, and an
 * upload knows its own bytes, name, and type.
 */
final class BuilderTest extends TestCase
{
    public function testAnInlineKeyboardLaysButtonsOutInRows(): void
    {
        $keyboard = InlineKeyboard::new()
            ->callback('Ship it', 'deploy:yes')
            ->callback('Hold', 'deploy:no')
            ->row()
            ->url('What changed', 'https://example.com/diff');

        $this->assertSame([
            'inline_keyboard' => [
                [
                    ['text' => 'Ship it', 'callback_data' => 'deploy:yes'],
                    ['text' => 'Hold', 'callback_data' => 'deploy:no'],
                ],
                [
                    ['text' => 'What changed', 'url' => 'https://example.com/diff'],
                ],
            ],
        ], $keyboard->jsonSerialize());
    }

    public function testAnInlineKeyboardCoversTheOtherButtonKinds(): void
    {
        $keyboard = InlineKeyboard::new()
            ->webApp('Open', 'https://example.com/app')
            ->switchInline('Share', 'query')
            ->switchInline('Here', 'query', currentChat: true)
            ->copyText('Copy', 'the-code')
            ->pay('Pay')
            ->login('Sign in', 'https://example.com/login', requestWriteAccess: true)
            ->button(['text' => 'Raw', 'callback_data' => 'raw']);

        $row = $keyboard->jsonSerialize()['inline_keyboard'][0];

        $this->assertSame(['url' => 'https://example.com/app'], $row[0]['web_app']);
        $this->assertSame('query', $row[1]['switch_inline_query']);
        $this->assertSame('query', $row[2]['switch_inline_query_current_chat']);
        $this->assertSame(['text' => 'the-code'], $row[3]['copy_text']);
        $this->assertTrue($row[4]['pay']);
        $this->assertSame(
            ['url' => 'https://example.com/login', 'request_write_access' => true],
            $row[5]['login_url'],
        );
        $this->assertSame(['text' => 'Raw', 'callback_data' => 'raw'], $row[6]);
    }

    public function testAnEmptyTrailingRowIsDropped(): void
    {
        $keyboard = InlineKeyboard::new()->callback('Only', 'one')->row();

        $this->assertCount(1, $keyboard->jsonSerialize()['inline_keyboard']);
    }

    public function testAReplyKeyboardCarriesItsButtonsAndOptions(): void
    {
        $keyboard = ReplyKeyboard::new()
            ->requestLocation('Send my location')
            ->row()
            ->button('Skip')
            ->requestContact('Share my number')
            ->resize()
            ->oneTime()
            ->persistent()
            ->placeholder('Pick one')
            ->selective();

        $markup = $keyboard->jsonSerialize();

        $this->assertSame([
            [['text' => 'Send my location', 'request_location' => true]],
            [
                ['text' => 'Skip'],
                ['text' => 'Share my number', 'request_contact' => true],
            ],
        ], $markup['keyboard']);

        $this->assertTrue($markup['resize_keyboard']);
        $this->assertTrue($markup['one_time_keyboard']);
        $this->assertTrue($markup['is_persistent']);
        $this->assertTrue($markup['selective']);
        $this->assertSame('Pick one', $markup['input_field_placeholder']);
    }

    public function testAReplyKeyboardCanAskForUsersAndChats(): void
    {
        $markup = ReplyKeyboard::new()
            ->requestUsers('Pick people', 1, ['max_quantity' => 3])
            ->requestChat('Pick a channel', 2, chatIsChannel: true)
            ->webApp('Open', 'https://example.com/app')
            ->requestPoll('Make a poll', 'quiz')
            ->jsonSerialize();

        $row = $markup['keyboard'][0];

        $this->assertSame(['request_id' => 1, 'max_quantity' => 3], $row[0]['request_users']);
        $this->assertSame(['request_id' => 2, 'chat_is_channel' => true], $row[1]['request_chat']);
        $this->assertSame(['url' => 'https://example.com/app'], $row[2]['web_app']);
        $this->assertSame(['type' => 'quiz'], $row[3]['request_poll']);
    }

    public function testTheOtherReplyMarkupsAreAvailable(): void
    {
        $this->assertSame(['remove_keyboard' => true, 'selective' => false], ReplyKeyboard::remove());
        $this->assertSame(
            ['force_reply' => true, 'input_field_placeholder' => 'Your answer', 'selective' => false],
            ReplyKeyboard::forceReply('Your answer'),
        );
    }

    public function testAnUploadFromMemoryKnowsItsNameAndType(): void
    {
        $file = InputFile::fromString('bytes', 'note.txt', 'text/plain');

        $this->assertSame('bytes', $file->getContents());
        $this->assertSame('note.txt', $file->getFilename());
        $this->assertSame('text/plain', $file->getContentType());
        $this->assertNull($file->getPath());
        $this->assertSame('attach://note.txt', (string) $file);
    }

    public function testAnUploadFromDiskReadsTheFile(): void
    {
        $path = sys_get_temp_dir() . '/telegramphp-' . bin2hex(random_bytes(4)) . '.txt';
        file_put_contents($path, 'on disk');

        try {
            $file = InputFile::fromPath($path);

            $this->assertSame('on disk', $file->getContents());
            $this->assertSame(basename($path), $file->getFilename());
            $this->assertSame($path, $file->getPath());
        } finally {
            @unlink($path);
        }
    }

    public function testAnUploadFromAStreamDrainsIt(): void
    {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, 'streamed');
        rewind($stream);

        try {
            $this->assertSame('streamed', InputFile::fromStream($stream, 'stream.bin')->getContents());
        } finally {
            fclose($stream);
        }
    }

    public function testAMissingFileIsRefusedUpFront(): void
    {
        $this->expectException(FileNotFoundException::class);

        InputFile::fromPath(sys_get_temp_dir() . '/telegramphp-does-not-exist-' . bin2hex(random_bytes(4)));
    }
}
