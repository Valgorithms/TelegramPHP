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
 * This object represents the audios displayed on a user's profile.
 *
 * @property int                                                $total_count Total number of profile audios for the target user
 * @property \Discord\Helpers\Collection<\Telegram\Parts\Audio> $audios Requested profile audios
 *
 * @link https://core.telegram.org/bots/api#userprofileaudios
 *
 * @since v10.3
 */
class UserProfileAudios extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'total_count',
        'audios',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'audios' => 'Array of Audio',
    ];
}
