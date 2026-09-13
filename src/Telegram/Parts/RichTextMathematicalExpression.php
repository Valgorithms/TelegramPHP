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
 * A mathematical expression.
 *
 * @property string $type Type of the rich text, always "mathematical_expression"
 * @property string $expression The expression in LaTeX format
 *
 * @link https://core.telegram.org/bots/api#richtextmathematicalexpression
 *
 * @since Bot API 10.3
 */
class RichTextMathematicalExpression extends RichText
{
    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [];

    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = null;

    /** @var list<string> */
    protected array $fillable = [
        'type',
        'expression',
    ];
}
