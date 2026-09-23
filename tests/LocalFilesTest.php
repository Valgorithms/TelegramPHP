<?php

declare(strict_types=1);

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Tests;

use PHPUnit\Framework\Attributes\DataProvider;

use function React\Async\await;

use React\EventLoop\Loop;
use Telegram\Exceptions\FileNotFoundException;
use Telegram\Exceptions\TelegramException;
use Telegram\Http\LocalFiles;
use Telegram\Parts\File;
use Telegram\Telegram;

/**
 * A local Bot API server's files, read from its disk rather than over HTTP.
 *
 * Every path here is a real file in a temporary directory, so the mapping, the
 * containment checks and the reads are all exercised against the filesystem
 * the client will actually run on — Windows included.
 */
final class LocalFilesTest extends SpecTestCase
{
    /** Where the server's volume is mounted, as this process sees it. */
    private string $root;

    /** A file next to the root, which nothing should be able to reach. */
    private string $outside;

    protected function setUp(): void
    {
        $base = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'tg-local-' . bin2hex(random_bytes(6));
        $this->root = $base . DIRECTORY_SEPARATOR . 'volume';
        mkdir($this->root . DIRECTORY_SEPARATOR . 'TOKEN' . DIRECTORY_SEPARATOR . 'documents', 0o777, true);
        file_put_contents($this->root . DIRECTORY_SEPARATOR . 'TOKEN' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR . 'file_1.txt', 'local bytes');

        $this->outside = $base . DIRECTORY_SEPARATOR . 'secret.txt';
        file_put_contents($this->outside, 'not yours');
    }

    protected function tearDown(): void
    {
        $base = dirname($this->root);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        foreach ($files as $file) {
            $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
        }

        rmdir($base);
    }

    // -- Telling a local path from a cloud one --------------------------------

    /** @return iterable<string, array{?string, bool}> */
    public static function paths(): iterable
    {
        yield 'cloud' => ['photos/file_12.jpg', false];
        yield 'nothing' => [null, false];
        yield 'empty' => ['', false];
        yield 'posix' => ['/var/lib/telegram-bot-api/TOKEN/photos/file_12.jpg', true];
        yield 'drive letter' => ['C:\telegram-bot-api\TOKEN\photos\file_12.jpg', true];
        yield 'drive letter, forward slashes' => ['C:/telegram-bot-api/TOKEN/photos/file_12.jpg', true];
        yield 'unc share' => ['\\\\nas\share\TOKEN\file.jpg', true];
    }

    #[DataProvider('paths')]
    public function testALocalServersPathsAreAbsoluteAndTheCloudsAreNot(?string $path, bool $local): void
    {
        $this->assertSame($local, LocalFiles::isLocalPath($path));
    }

    // -- Mapping the server's path to this process's ---------------------------

    public function testOnTheSameMachineThePathIsUsedAsItIs(): void
    {
        $file = $this->root . DIRECTORY_SEPARATOR . 'TOKEN' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR . 'file_1.txt';

        $this->assertSame(realpath($file), $this->files([$this->root])->toLocal($file));
    }

    public function testInDockerTheServersPathIsMappedToTheVolume(): void
    {
        $local = $this->files(['/var/lib/telegram-bot-api' => $this->root])
            ->toLocal('/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt');

        $this->assertSame(realpath($this->root . '/TOKEN/documents/file_1.txt'), $local);
    }

    public function testAPrefixOnlyMatchesWholeDirectories(): void
    {
        // `/srv/bot` must not claim `/srv/bot-two`.
        $this->expectException(TelegramException::class);
        $this->expectExceptionMessage('not under any directory');

        $this->files(['/var/lib/telegram-bot-api' => $this->root])
            ->toLocal('/var/lib/telegram-bot-api-two/TOKEN/documents/file_1.txt');
    }

    public function testAPathThatClimbsOutOfTheVolumeIsRefused(): void
    {
        // The path comes from the server. Followed blindly, it would read — and
        // hand to whatever uploads it next — any file this process can open.
        $this->expectException(TelegramException::class);
        $this->expectExceptionMessage('resolves outside');

        $this->files(['/var/lib/telegram-bot-api' => $this->root])
            ->toLocal('/var/lib/telegram-bot-api/../secret.txt');
    }

    public function testWithoutLocalFilesALocalPathSaysWhatToConfigure(): void
    {
        $this->expectException(TelegramException::class);
        $this->expectExceptionMessage('local_files');

        $this->files([])->toLocal('/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt');
    }

    public function testAMissingFileSaysWhereItLooked(): void
    {
        $this->expectException(FileNotFoundException::class);

        $this->files(['/var/lib/telegram-bot-api' => $this->root])
            ->toLocal('/var/lib/telegram-bot-api/TOKEN/documents/gone.txt');
    }

    // -- Uploading by path -------------------------------------------------------

    public function testALocalFileBecomesAUriInTheServersTerms(): void
    {
        $spaced = $this->root . DIRECTORY_SEPARATOR . 'TOKEN' . DIRECTORY_SEPARATOR . 'my video #1.mp4';
        file_put_contents($spaced, 'x');

        $this->assertSame(
            'file:///var/lib/telegram-bot-api/TOKEN/my%20video%20%231.mp4',
            $this->files(['/var/lib/telegram-bot-api' => $this->root])->toUri($spaced),
        );
    }

    public function testOnTheSameMachineTheUriIsTheFilesOwnPath(): void
    {
        $file = $this->root . DIRECTORY_SEPARATOR . 'TOKEN' . DIRECTORY_SEPARATOR . 'documents' . DIRECTORY_SEPARATOR . 'file_1.txt';
        $uri = $this->files([$this->root])->toUri($file);

        $this->assertStringStartsWith('file:///', $uri);
        $this->assertStringEndsWith('/TOKEN/documents/file_1.txt', $uri);
    }

    public function testAFileTheServerCannotSeeHasNoUri(): void
    {
        $this->expectException(TelegramException::class);

        $this->files(['/var/lib/telegram-bot-api' => $this->root])->toUri($this->outside);
    }

    // -- Reading ---------------------------------------------------------------

    public function testAFileIsReadAcrossSeveralTicks(): void
    {
        $big = $this->root . DIRECTORY_SEPARATOR . 'big.bin';
        $bytes = random_bytes(10_000);
        file_put_contents($big, $bytes);

        // A tiny chunk forces the read across many ticks.
        $files = new LocalFiles([$this->root], Loop::get(), 1024);

        $this->assertSame($bytes, await($files->read($big)));
    }

    public function testAFileIsCopiedWithoutBeingHeldWhole(): void
    {
        $big = $this->root . DIRECTORY_SEPARATOR . 'big.bin';
        $bytes = random_bytes(10_000);
        file_put_contents($big, $bytes);
        $copy = dirname($this->root) . DIRECTORY_SEPARATOR . 'copy.bin';

        $files = new LocalFiles([$this->root], Loop::get(), 1024);

        $this->assertSame($copy, await($files->copy($big, $copy)));
        $this->assertSame($bytes, file_get_contents($copy));
    }

    // -- Through the client ----------------------------------------------------

    public function testDownloadingFromALocalServerReadsTheDiskNotHttp(): void
    {
        $http = new ScriptedHttp();
        $http->script = [['file_id' => 'f-1', 'file_unique_id' => 'u-1', 'file_path' => '/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt']];
        $telegram = $this->localClient($http);

        $this->assertSame('local bytes', await($telegram->downloadFile('f-1')));
        $this->assertCount(1, $http->calls, 'only getFile; nothing downloaded over HTTP');
    }

    public function testACloudFileStillComesOverHttp(): void
    {
        $http = new ScriptedHttp();
        $http->script = [['file_id' => 'f-1', 'file_unique_id' => 'u-1', 'file_path' => 'photos/file_1.jpg']];

        $this->assertSame('file-bytes', await($this->localClient($http)->downloadFile('f-1')));
        $this->assertSame('@download', $http->lastCall()[0] ?? null);
    }

    public function testALocalPathWithoutLocalFilesRejectsInsteadOfFetchingNonsense(): void
    {
        $http = new ScriptedHttp();
        $http->script = [['file_id' => 'f-1', 'file_unique_id' => 'u-1', 'file_path' => '/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt']];

        $this->expectException(TelegramException::class);
        $this->expectExceptionMessage('local_files');

        await($this->client($http)->downloadFile('f-1'));
    }

    public function testTheLocalPathIsAvailableForFilesTooBigToHoldInMemory(): void
    {
        $telegram = $this->localClient(new ScriptedHttp());

        $this->assertSame(
            realpath($this->root . '/TOKEN/documents/file_1.txt'),
            await($telegram->localFilePath($this->file($telegram, '/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt'))),
        );
        $this->assertNull(await($telegram->localFilePath($this->file($telegram, 'photos/file_1.jpg'))));
    }

    public function testALocalFilePartSavesByCopyingAndHasNoUrl(): void
    {
        $telegram = $this->localClient(new ScriptedHttp());
        $file = $this->file($telegram, '/var/lib/telegram-bot-api/TOKEN/documents/file_1.txt');
        $target = dirname($this->root);

        $this->assertTrue($file->isLocal());
        $this->assertSame($target . DIRECTORY_SEPARATOR . 'file_1.txt', await($file->save($target)));
        $this->assertSame('local bytes', file_get_contents($target . DIRECTORY_SEPARATOR . 'file_1.txt'));

        $this->expectException(TelegramException::class);
        $file->getUrl();
    }

    /** @param array<int|string, string> $roots */
    private function files(array $roots): LocalFiles
    {
        return new LocalFiles($roots, Loop::get());
    }

    private function localClient(ScriptedHttp $http): Telegram
    {
        return new Telegram([
            'token' => 'TEST:TOKEN',
            'http' => $http,
            'local_files' => ['/var/lib/telegram-bot-api' => $this->root],
        ]);
    }

    private function file(Telegram $telegram, string $filePath): File
    {
        /** @var File */
        return $telegram->getFactory()->part(File::class, [
            'file_id' => 'f-1',
            'file_unique_id' => 'u-1',
            'file_path' => $filePath,
        ]);
    }
}
