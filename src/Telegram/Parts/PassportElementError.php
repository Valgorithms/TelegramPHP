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
 * This object represents an error in the Telegram Passport element which was submitted that should
 * be resolved by the user. It should be one of:
 * - PassportElementErrorDataField
 * - PassportElementErrorFrontSide
 * - PassportElementErrorReverseSide
 * - PassportElementErrorSelfie
 * - PassportElementErrorFile
 * - PassportElementErrorFiles
 * - PassportElementErrorTranslationFile
 * - PassportElementErrorTranslationFiles
 * - PassportElementErrorUnspecified
 *
 * One of: PassportElementErrorDataField, PassportElementErrorFrontSide, PassportElementErrorReverseSide, PassportElementErrorSelfie, PassportElementErrorFile, PassportElementErrorFiles, PassportElementErrorTranslationFile, PassportElementErrorTranslationFiles, PassportElementErrorUnspecified.
 *
 * @link https://core.telegram.org/bots/api#passportelementerror
 *
 * @since Bot API 10.3
 */
abstract class PassportElementError extends Part
{
    /** The attribute whose value names the concrete subtype. */
    public const DISCRIMINATOR = 'source';

    /** @var array<string, class-string<Part>>|list<class-string<Part>> */
    public const SUBTYPES = [
        'data'              => PassportElementErrorDataField::class,
        'front_side'        => PassportElementErrorFrontSide::class,
        'reverse_side'      => PassportElementErrorReverseSide::class,
        'selfie'            => PassportElementErrorSelfie::class,
        'file'              => PassportElementErrorFile::class,
        'files'             => PassportElementErrorFiles::class,
        'translation_file'  => PassportElementErrorTranslationFile::class,
        'translation_files' => PassportElementErrorTranslationFiles::class,
        'unspecified'       => PassportElementErrorUnspecified::class,
    ];
}
