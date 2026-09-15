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
 * Represents an invite link for a chat.
 *
 * @property string                       $invite_link The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with "...".
 * @property \Telegram\Parts\User         $creator Creator of the link
 * @property bool                         $creates_join_request True, if users joining the chat via the link need to be approved by chat administrators
 * @property bool                         $is_primary True, if the link is primary
 * @property bool                         $is_revoked True, if the link is revoked
 * @property string|null                  $name Optional. Invite link name
 * @property \Carbon\CarbonImmutable|null $expire_date Optional. Point in time (Unix timestamp) when the link will expire or has been expired
 * @property int|null                     $member_limit Optional. The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
 * @property int|null                     $pending_join_request_count Optional. Number of pending join requests created using this link
 * @property int|null                     $subscription_period Optional. The number of seconds the subscription will be active for before the next payment
 * @property int|null                     $subscription_price Optional. The amount of Telegram Stars a user must pay initially and after each subsequent subscription period to be a member of the chat using the link
 *
 * @link https://core.telegram.org/bots/api#chatinvitelink
 *
 * @since v10.3
 */
class ChatInviteLink extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'invite_link',
        'creator',
        'creates_join_request',
        'is_primary',
        'is_revoked',
        'name',
        'expire_date',
        'member_limit',
        'pending_join_request_count',
        'subscription_period',
        'subscription_price',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'creator' => 'User',
    ];

    /** @var list<string> */
    protected array $dates = [
        'expire_date',
    ];
}
