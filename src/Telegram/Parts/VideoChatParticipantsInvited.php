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
 * This object represents a service message about new members invited to a video chat.
 *
 * @property \Discord\Helpers\Collection<\Telegram\Parts\User> $users New members that were invited to the video chat
 *
 * @link https://core.telegram.org/bots/api#videochatparticipantsinvited
 *
 * @since v10.3
 */
class VideoChatParticipantsInvited extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'users',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'users' => 'Array of User',
    ];
}
