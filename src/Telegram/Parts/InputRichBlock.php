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
 * This object represents a block in a rich formatted message to be sent. Currently, it can be any
 * of the following types:
 * - InputRichBlockParagraph
 * - InputRichBlockSectionHeading
 * - InputRichBlockPreformatted
 * - InputRichBlockFooter
 * - InputRichBlockDivider
 * - InputRichBlockMathematicalExpression
 * - InputRichBlockAnchor
 * - InputRichBlockList
 * - InputRichBlockBlockQuotation
 * - InputRichBlockExpandableBlockQuotation
 * - InputRichBlockPullQuotation
 * - InputRichBlockCollage
 * - InputRichBlockSlideshow
 * - InputRichBlockTable
 * - InputRichBlockDetails
 * - InputRichBlockMap
 * - InputRichBlockButtons
 * - InputRichBlockAnimation
 * - InputRichBlockAudio
 * - InputRichBlockDocument
 * - InputRichBlockPhoto
 * - InputRichBlockVideo
 * - InputRichBlockVoiceNote
 * - InputRichBlockThinking
 *
 * One of: InputRichBlockParagraph, InputRichBlockSectionHeading, InputRichBlockPreformatted, InputRichBlockFooter, InputRichBlockDivider, InputRichBlockMathematicalExpression, InputRichBlockAnchor, InputRichBlockList, InputRichBlockBlockQuotation, InputRichBlockExpandableBlockQuotation, InputRichBlockPullQuotation, InputRichBlockCollage, InputRichBlockSlideshow, InputRichBlockTable, InputRichBlockDetails, InputRichBlockMap, InputRichBlockButtons, InputRichBlockAnimation, InputRichBlockAudio, InputRichBlockDocument, InputRichBlockPhoto, InputRichBlockVideo, InputRichBlockVoiceNote, InputRichBlockThinking.
 *
 * @link https://core.telegram.org/bots/api#inputrichblock
 *
 * @since Bot API 10.3
 */
abstract class InputRichBlock extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'type';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'paragraph'               => InputRichBlockParagraph::class,
        'heading'                 => InputRichBlockSectionHeading::class,
        'pre'                     => InputRichBlockPreformatted::class,
        'footer'                  => InputRichBlockFooter::class,
        'divider'                 => InputRichBlockDivider::class,
        'mathematical_expression' => InputRichBlockMathematicalExpression::class,
        'anchor'                  => InputRichBlockAnchor::class,
        'list'                    => InputRichBlockList::class,
        'blockquote'              => InputRichBlockBlockQuotation::class,
        'expandable_blockquote'   => InputRichBlockExpandableBlockQuotation::class,
        'pullquote'               => InputRichBlockPullQuotation::class,
        'collage'                 => InputRichBlockCollage::class,
        'slideshow'               => InputRichBlockSlideshow::class,
        'table'                   => InputRichBlockTable::class,
        'details'                 => InputRichBlockDetails::class,
        'map'                     => InputRichBlockMap::class,
        'buttons'                 => InputRichBlockButtons::class,
        'animation'               => InputRichBlockAnimation::class,
        'audio'                   => InputRichBlockAudio::class,
        'document'                => InputRichBlockDocument::class,
        'photo'                   => InputRichBlockPhoto::class,
        'video'                   => InputRichBlockVideo::class,
        'voice_note'              => InputRichBlockVoiceNote::class,
        'thinking'                => InputRichBlockThinking::class,
    ];
}
