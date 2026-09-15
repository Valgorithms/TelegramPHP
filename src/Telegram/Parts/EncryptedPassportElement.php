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
 * Describes documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @property string                                                         $type Element type. One of "personal_details", "passport", "driver_license", "identity_card", "internal_passport", "address", "utility_bill", "bank_statement", "rental_agreement", "passport_registration", "temporary_registration", "phone_number", "email".
 * @property string|null                                                    $data Optional. Base64-encoded encrypted Telegram Passport element data provided by the user; available only for "personal_details", "passport", "driver_license", "identity_card", "internal_passport" and "address" types. Can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property string|null                                                    $phone_number Optional. User's verified phone number; available only for "phone_number" type
 * @property string|null                                                    $email Optional. User's verified email address; available only for "email" type
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PassportFile>|null $files Optional. Array of encrypted files with documents provided by the user; available only for "utility_bill", "bank_statement", "rental_agreement", "passport_registration" and "temporary_registration" types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property \Telegram\Parts\PassportFile|null                              $front_side Optional. Encrypted file with the front side of the document, provided by the user; available only for "passport", "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property \Telegram\Parts\PassportFile|null                              $reverse_side Optional. Encrypted file with the reverse side of the document, provided by the user; available only for "driver_license" and "identity_card". The file can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property \Telegram\Parts\PassportFile|null                              $selfie Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available if requested for "passport", "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\PassportFile>|null $translation Optional. Array of encrypted files with translated versions of documents provided by the user; available if requested for "passport", "driver_license", "identity_card", "internal_passport", "utility_bill", "bank_statement", "rental_agreement", "passport_registration" and "temporary_registration" types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
 * @property string                                                         $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
 *
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 *
 * @since v10.3
 */
class EncryptedPassportElement extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'type',
        'data',
        'phone_number',
        'email',
        'files',
        'front_side',
        'reverse_side',
        'selfie',
        'translation',
        'hash',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'files'        => 'Array of PassportFile',
        'front_side'   => 'PassportFile',
        'reverse_side' => 'PassportFile',
        'selfie'       => 'PassportFile',
        'translation'  => 'Array of PassportFile',
    ];
}
