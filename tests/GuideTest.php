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

use Telegram\Events\Event;

/**
 * The guide is hand-written prose and mostly cannot be tested - but the parts of
 * it that are structure rather than prose can be, and those are the parts that
 * break quietly: a page nobody linked, a cross-reference to a page that was
 * renamed, a generated table that stopped matching what it documents.
 */
final class GuideTest extends SpecTestCase
{
    private const GUIDE = __DIR__ . '/../guide';

    /** @return list<string> Page names, without the .rst. */
    private static function pages(): array
    {
        return array_map(
            static fn (string $path): string => basename($path, '.rst'),
            glob(self::GUIDE . '/*.rst'),
        );
    }

    private static function toctree(): array
    {
        $index = (string) file_get_contents(self::GUIDE . '/index.rst');
        $entries = [];

        foreach (explode("\n", $index) as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '..') || str_starts_with($line, ':')) {
                continue;
            }

            // The toctree is the first block of bare page names in the file.
            if (! preg_match('/^[a-z0-9_\/-]+$/', $line)) {
                break;
            }

            $entries[] = $line;
        }

        return $entries;
    }

    public function testEveryPageIsInTheTableOfContents(): void
    {
        $toctree = self::toctree();

        $this->assertNotEmpty($toctree, 'guide/index.rst has no toctree.');

        foreach (self::pages() as $page) {
            $this->assertContains(
                $page,
                $toctree,
                "guide/{$page}.rst is not in the toctree in index.rst, so it will not be published.",
            );
        }
    }

    public function testTheTableOfContentsOnlyListsPagesThatExist(): void
    {
        foreach (self::toctree() as $entry) {
            $this->assertFileExists(
                self::GUIDE . '/' . $entry . '.rst',
                "index.rst links to {$entry}, which does not exist.",
            );
        }
    }

    public function testCrossReferencesPointAtRealPages(): void
    {
        $pages = self::pages();

        foreach (glob(self::GUIDE . '/*.rst') as $path) {
            preg_match_all('/:doc:`([a-z0-9_\/-]+)`/', (string) file_get_contents($path), $matches);

            foreach ($matches[1] as $target) {
                $this->assertContains(
                    $target,
                    $pages,
                    basename($path) . " links to :doc:`{$target}`, which is not a page.",
                );
            }
        }
    }

    public function testTheGeneratedUpdateTableCoversEveryUpdateType(): void
    {
        $table = (string) file_get_contents(self::GUIDE . '/_generated/update-types.rst');

        $this->assertStringStartsWith(':orphan:', $table, 'The included fragment must be marked :orphan:.');

        foreach (Event::PAYLOAD_TYPES as $type => $token) {
            $this->assertStringContainsString(
                '``Event::' . strtoupper($type) . '``',
                $table,
                "The guide's update table is missing {$type} - re-run `composer spec:generate`.",
            );
            $this->assertStringContainsString('``' . $token . '``', $table);
        }

        $rows = substr_count($table, '   * - ``Event::');

        $this->assertCount(
            $rows,
            Event::PAYLOAD_TYPES,
            "The guide's update table has rows for types that no longer exist.",
        );
    }

    public function testTheGeneratedTableIsIncludedRatherThanCopied(): void
    {
        $this->assertStringContainsString(
            '.. include:: _generated/update-types.rst',
            (string) file_get_contents(self::GUIDE . '/events.rst'),
            'events.rst should include the generated table, not carry a copy of it.',
        );
    }

    public function testThePhpDocumentorConfigBuildsBothTheReferenceAndTheGuide(): void
    {
        $config = (string) file_get_contents(__DIR__ . '/../phpdoc.dist.xml');

        $this->assertStringContainsString('<path>src</path>', $config);
        $this->assertStringContainsString('<path>guide</path>', $config);
        $this->assertStringContainsString('name="guides.enabled" value="true"', $config);
    }
}
