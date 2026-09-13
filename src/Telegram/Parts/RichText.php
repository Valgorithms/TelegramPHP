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
 * This object represents a rich formatted text. Currently, it can be either a String for plain
 * text, an Array of RichText, or any of the following types:
 * - RichTextBold
 * - RichTextItalic
 * - RichTextUnderline
 * - RichTextStrikethrough
 * - RichTextSpoiler
 * - RichTextDateTime
 * - RichTextTextMention
 * - RichTextSubscript
 * - RichTextSuperscript
 * - RichTextMarked
 * - RichTextCode
 * - RichTextCustomEmoji
 * - RichTextMathematicalExpression
 * - RichTextUrl
 * - RichTextEmailAddress
 * - RichTextPhoneNumber
 * - RichTextBankCardNumber
 * - RichTextMention
 * - RichTextHashtag
 * - RichTextCashtag
 * - RichTextBotCommand
 * - RichTextButton
 * - RichTextAnchor
 * - RichTextAnchorLink
 * - RichTextReference
 * - RichTextReferenceLink
 *
 * One of: String, Array of RichText, RichTextBold, RichTextItalic, RichTextUnderline, RichTextStrikethrough, RichTextSpoiler, RichTextDateTime, RichTextTextMention, RichTextSubscript, RichTextSuperscript, RichTextMarked, RichTextCode, RichTextCustomEmoji, RichTextMathematicalExpression, RichTextUrl, RichTextEmailAddress, RichTextPhoneNumber, RichTextBankCardNumber, RichTextMention, RichTextHashtag, RichTextCashtag, RichTextBotCommand, RichTextButton, RichTextAnchor, RichTextAnchorLink, RichTextReference, RichTextReferenceLink.
 *
 * @link https://core.telegram.org/bots/api#richtext
 *
 * @since Bot API 10.3
 */
abstract class RichText extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        RichTextBold::class,
        RichTextItalic::class,
        RichTextUnderline::class,
        RichTextStrikethrough::class,
        RichTextSpoiler::class,
        RichTextDateTime::class,
        RichTextTextMention::class,
        RichTextSubscript::class,
        RichTextSuperscript::class,
        RichTextMarked::class,
        RichTextCode::class,
        RichTextCustomEmoji::class,
        RichTextMathematicalExpression::class,
        RichTextUrl::class,
        RichTextEmailAddress::class,
        RichTextPhoneNumber::class,
        RichTextBankCardNumber::class,
        RichTextMention::class,
        RichTextHashtag::class,
        RichTextCashtag::class,
        RichTextBotCommand::class,
        RichTextButton::class,
        RichTextAnchor::class,
        RichTextAnchorLink::class,
        RichTextReference::class,
        RichTextReferenceLink::class,
    ];
}
