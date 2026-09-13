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
 * Describes the current status of a webhook.
 *
 * @property string                       $url Webhook URL, may be empty if webhook is not set up
 * @property bool                         $has_custom_certificate True, if a custom certificate was provided for webhook certificate checks
 * @property int                          $pending_update_count Number of updates awaiting delivery
 * @property string|null                  $ip_address Optional. Currently used webhook IP address
 * @property \Carbon\CarbonImmutable|null $last_error_date Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
 * @property string|null                  $last_error_message Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
 * @property \Carbon\CarbonImmutable|null $last_synchronization_error_date Optional. Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
 * @property int|null                     $max_connections Optional. The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
 * @property array<int, string>|null      $allowed_updates Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member, message_reaction, and message_reaction_count.
 *
 * @link https://core.telegram.org/bots/api#webhookinfo
 *
 * @since Bot API 10.3
 */
class WebhookInfo extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'url',
        'has_custom_certificate',
        'pending_update_count',
        'ip_address',
        'last_error_date',
        'last_error_message',
        'last_synchronization_error_date',
        'max_connections',
        'allowed_updates',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'allowed_updates' => 'Array of String',
    ];

    /** @var list<string> */
    protected array $dates = [
        'last_error_date',
        'last_synchronization_error_date',
    ];
}
