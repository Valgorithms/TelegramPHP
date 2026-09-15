<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * This object represents a block in a rich formatted message. Currently, it can be any of the
 * following types:
 * - RichBlockParagraph
 * - RichBlockSectionHeading
 * - RichBlockPreformatted
 * - RichBlockFooter
 * - RichBlockDivider
 * - RichBlockMathematicalExpression
 * - RichBlockAnchor
 * - RichBlockList
 * - RichBlockBlockQuotation
 * - RichBlockExpandableBlockQuotation
 * - RichBlockPullQuotation
 * - RichBlockCollage
 * - RichBlockSlideshow
 * - RichBlockTable
 * - RichBlockDetails
 * - RichBlockMap
 * - RichBlockButtons
 * - RichBlockAnimation
 * - RichBlockAudio
 * - RichBlockDocument
 * - RichBlockPhoto
 * - RichBlockVideo
 * - RichBlockVoiceNote
 * - RichBlockThinking
 *
 * One of: RichBlockParagraph, RichBlockSectionHeading, RichBlockPreformatted, RichBlockFooter, RichBlockDivider, RichBlockMathematicalExpression, RichBlockAnchor, RichBlockList, RichBlockBlockQuotation, RichBlockExpandableBlockQuotation, RichBlockPullQuotation, RichBlockCollage, RichBlockSlideshow, RichBlockTable, RichBlockDetails, RichBlockMap, RichBlockButtons, RichBlockAnimation, RichBlockAudio, RichBlockDocument, RichBlockPhoto, RichBlockVideo, RichBlockVoiceNote, RichBlockThinking.
 *
 * @link https://core.telegram.org/bots/api#richblock
 *
 * @since v10.3
 */
abstract class RichBlock extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'paragraph'               => RichBlockParagraph::class,
        'heading'                 => RichBlockSectionHeading::class,
        'pre'                     => RichBlockPreformatted::class,
        'footer'                  => RichBlockFooter::class,
        'divider'                 => RichBlockDivider::class,
        'mathematical_expression' => RichBlockMathematicalExpression::class,
        'anchor'                  => RichBlockAnchor::class,
        'list'                    => RichBlockList::class,
        'blockquote'              => RichBlockBlockQuotation::class,
        'expandable_blockquote'   => RichBlockExpandableBlockQuotation::class,
        'pullquote'               => RichBlockPullQuotation::class,
        'collage'                 => RichBlockCollage::class,
        'slideshow'               => RichBlockSlideshow::class,
        'table'                   => RichBlockTable::class,
        'details'                 => RichBlockDetails::class,
        'map'                     => RichBlockMap::class,
        'buttons'                 => RichBlockButtons::class,
        'animation'               => RichBlockAnimation::class,
        'audio'                   => RichBlockAudio::class,
        'document'                => RichBlockDocument::class,
        'photo'                   => RichBlockPhoto::class,
        'video'                   => RichBlockVideo::class,
        'voice_note'              => RichBlockVoiceNote::class,
        'thinking'                => RichBlockThinking::class,
    ];
}
