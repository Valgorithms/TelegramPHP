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

use function React\Async\await;

use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use Telegram\Builders\InputFile;
use Telegram\Http\Exceptions\BadRequestException;
use Telegram\Http\Exceptions\ForbiddenException;
use Telegram\Http\Exceptions\HttpException;
use Telegram\Http\Exceptions\TooManyRequestsException;
use Telegram\Http\Exceptions\UnauthorizedException;
use Telegram\Http\Http;

/**
 * The transport: what it sends, what it unwraps, and what it does when Telegram
 * says no.
 */
final class HttpTest extends TestCase
{
    private LoopInterface $loop;

    protected function setUp(): void
    {
        $this->loop = Loop::get();
    }

    private function http(FakeDriver $driver): Http
    {
        return new Http('TEST:TOKEN', $this->loop, null, $driver);
    }

    public function testASuccessfulCallResolvesWithTheUnwrappedResult(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(['message_id' => 11, 'text' => 'hi']));

        $result = await($this->http($driver)->execute('sendMessage', ['chat_id' => 1, 'text' => 'hi']));

        $this->assertSame(['message_id' => 11, 'text' => 'hi'], $result);
    }

    public function testTheRequestIsAJsonPostToTheMethodUrl(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(true));

        await($this->http($driver)->execute('sendMessage', ['chat_id' => 1, 'text' => 'hi']));

        $request = $driver->lastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://api.telegram.org/botTEST:TOKEN/sendMessage', $request->getUrl());
        $this->assertSame('application/json', $request->getHeaders()['Content-Type']);
        $this->assertSame('{"chat_id":1,"text":"hi"}', $request->getContent());
        $this->assertStringStartsWith('TelegramPHP/', $request->getHeaders()['User-Agent']);
    }

    public function testUnsetFieldsAreNotSent(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(true));

        await($this->http($driver)->execute('sendMessage', ['chat_id' => 1, 'text' => 'hi', 'parse_mode' => null]));

        $this->assertSame('{"chat_id":1,"text":"hi"}', $driver->lastRequest()->getContent());
    }

    public function testAFileTurnsTheRequestIntoAMultipartUpload(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(true));

        await($this->http($driver)->execute('sendPhoto', [
            'chat_id' => 1,
            'photo' => InputFile::fromString('bytes', 'cat.jpg', 'image/jpeg'),
        ]));

        $request = $driver->lastRequest();

        $this->assertStringStartsWith('multipart/form-data; boundary=', $request->getHeaders()['Content-Type']);
        $this->assertStringContainsString('name="photo"; filename="cat.jpg"', $request->getContent());
        $this->assertStringContainsString('name="chat_id"', $request->getContent());
    }

    public function testAnErrorEnvelopeBecomesATypedException(): void
    {
        $driver = new FakeDriver(FakeDriver::error(400, 'Bad Request: chat not found'));

        try {
            await($this->http($driver)->execute('sendMessage', ['chat_id' => 1, 'text' => 'hi']));
            $this->fail('The call should have rejected.');
        } catch (BadRequestException $e) {
            $this->assertSame(400, $e->getErrorCode());
            $this->assertSame('Bad Request: chat not found', $e->getMessage());
        }
    }

    public function testTheStatusChoosesTheExceptionClass(): void
    {
        foreach ([401 => UnauthorizedException::class, 403 => ForbiddenException::class] as $code => $class) {
            $driver = new FakeDriver(FakeDriver::error($code, 'nope'));

            try {
                await($this->http($driver)->execute('sendMessage'));
                $this->fail("A {$code} should have rejected.");
            } catch (HttpException $e) {
                $this->assertInstanceOf($class, $e);
            }
        }
    }

    public function testAMigratedChatReportsItsNewId(): void
    {
        $driver = new FakeDriver(FakeDriver::error(400, 'Bad Request: group chat was upgraded to a supergroup chat', [
            'migrate_to_chat_id' => -1001234567890,
        ]));

        try {
            await($this->http($driver)->execute('sendMessage', ['chat_id' => -42]));
            $this->fail('The call should have rejected.');
        } catch (BadRequestException $e) {
            $this->assertSame(-1001234567890, $e->getMigrateToChatId());
        }
    }

    public function testARateLimitedCallIsHeldAndReplayed(): void
    {
        $driver = new FakeDriver(
            FakeDriver::error(429, 'Too Many Requests: retry after 1', ['retry_after' => 1]),
            FakeDriver::ok(['sent' => true]),
        );

        $started = microtime(true);
        $result = await($this->http($driver)->execute('sendMessage', ['chat_id' => 1, 'text' => 'hi']));

        $this->assertSame(['sent' => true], $result);
        $this->assertCount(2, $driver->requests, 'The request should have been replayed once.');
        $this->assertGreaterThanOrEqual(0.9, microtime(true) - $started, 'The retry_after hold was not observed.');
    }

    public function testRateLimitingGivesUpAfterTheLastAttempt(): void
    {
        $driver = new FakeDriver(...array_fill(0, Http::MAX_ATTEMPTS, FakeDriver::error(429, 'Too Many Requests', ['retry_after' => 0])));

        try {
            await($this->http($driver)->execute('sendMessage'));
            $this->fail('The call should have rejected.');
        } catch (TooManyRequestsException $e) {
            $this->assertSame(429, $e->getErrorCode());
            $this->assertSame(0, $e->getRetryAfter());
            $this->assertCount(Http::MAX_ATTEMPTS, $driver->requests);
        }
    }

    public function testAServerErrorIsRetried(): void
    {
        $driver = new FakeDriver(
            FakeDriver::error(502, 'Bad Gateway'),
            FakeDriver::ok(true),
        );

        $this->assertTrue(await($this->http($driver)->execute('getMe')));
        $this->assertCount(2, $driver->requests);
    }

    public function testATransportFailureIsRetriedAndThenSurfaces(): void
    {
        $driver = new FakeDriver(...array_fill(0, Http::MAX_ATTEMPTS, new \RuntimeException('connection refused')));

        try {
            await($this->http($driver)->execute('getMe'));
            $this->fail('The call should have rejected.');
        } catch (HttpException $e) {
            $this->assertStringContainsString('connection refused', $e->getMessage());
            $this->assertCount(Http::MAX_ATTEMPTS, $driver->requests);
        }
    }

    public function testADownloadReturnsTheBytes(): void
    {
        $driver = new FakeDriver(FakeDriver::raw('PNG-BYTES'));
        $http = $this->http($driver);

        $this->assertSame('PNG-BYTES', await($http->download('photos/file_1.jpg')));

        $request = $driver->lastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://api.telegram.org/file/botTEST:TOKEN/photos/file_1.jpg', $request->getUrl());
    }

    public function testAFailedDownloadRejects(): void
    {
        $driver = new FakeDriver(FakeDriver::raw('Not Found', 404));

        $this->expectException(HttpException::class);

        await($this->http($driver)->download('photos/missing.jpg'));
    }

    public function testALocalBotApiServerCanBeUsedInstead(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(true));
        $http = new Http('TEST:TOKEN', $this->loop, null, $driver, 'http://127.0.0.1:8081');

        await($http->execute('getMe'));

        $this->assertSame('http://127.0.0.1:8081/botTEST:TOKEN/getMe', $driver->lastRequest()->getUrl());
        $this->assertSame('http://127.0.0.1:8081/file/botTEST:TOKEN/a/b.jpg', $http->fileUrl('a/b.jpg'));
    }

    public function testANewTokenIsUsedByLaterCalls(): void
    {
        $driver = new FakeDriver(FakeDriver::ok(true), FakeDriver::ok(true));
        $http = $this->http($driver);

        await($http->execute('getMe'));
        $http->setToken('OTHER:TOKEN');
        await($http->execute('getMe'));

        $this->assertSame('https://api.telegram.org/botOTHER:TOKEN/getMe', $driver->lastRequest()->getUrl());
    }
}
