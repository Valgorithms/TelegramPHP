<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Api;

use React\Promise\PromiseInterface;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * Receiving updates, by long polling or by webhook.
 *
 * Mixed into {@see \Telegram\Telegram} through {@see Methods}. Every method is
 * named exactly as the Bot API names it, takes exactly the fields the Bot API
 * documents (use named arguments for the optional ones), and resolves with the
 * hydrated result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since Bot API 10.3
 */
trait UpdateApi
{
    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates.
     * Returns True on success.
     *
     * @param bool|null $drop_pending_updates Optional. Pass True to drop all pending updates
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletewebhook
     */
    public function deleteWebhook(
        ?bool $drop_pending_updates = null,
    ): PromiseInterface {
        return $this->callApi('deleteWebhook', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to receive incoming updates using long polling (wiki). Returns an Array of
     * Update objects.
     *
     * @param int|null $offset Optional. Identifier of the first update to be returned. Must be greater by
     *        one than the highest among the identifiers of previously received updates. By default, updates
     *        starting with the earliest unconfirmed update are returned. An update is considered confirmed as
     *        soon as getUpdates is called with an offset higher than its update_id. The negative offset can be
     *        specified to retrieve updates starting from -offset update from the end of the updates queue. All
     *        previous updates will be forgotten.
     * @param int|null $limit Optional. Limits the number of updates to be retrieved. Values between 1-100
     *        are accepted. Defaults to 100.
     * @param int|null $timeout Optional. Timeout in seconds for long polling. Defaults to 0, i.e. usual
     *        short polling. Should be positive, short polling should be used for testing purposes only.
     * @param list<string>|null $allowed_updates Optional. A JSON-serialized list of the update types you
     *        want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"]
     *        to only receive updates of these types. See Update for a complete list of available update types.
     *        Specify an empty list to receive all update types except chat_member, message_reaction, and
     *        message_reaction_count (default). If not specified, the previous setting will be used. Please note
     *        that this parameter doesn't affect updates created before the call to getUpdates, so unwanted
     *        updates may be received for a short period of time.
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\Update>>
     *
     * @link https://core.telegram.org/bots/api#getupdates
     */
    public function getUpdates(
        ?int $offset = null,
        ?int $limit = null,
        ?int $timeout = null,
        ?array $allowed_updates = null,
    ): PromiseInterface {
        return $this->callApi('getUpdates', get_defined_vars(), ['Array of Update']);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a
     * WebhookInfo object. If the bot is using getUpdates, will return an object with the url field
     * empty.
     *
     * @return PromiseInterface<\Telegram\Parts\WebhookInfo>
     *
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     */
    public function getWebhookInfo(): PromiseInterface
    {
        return $this->callApi('getWebhookInfo', [], ['WebhookInfo']);
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever
     * there is an update for the bot, we will send an HTTPS POST request to the specified URL,
     * containing a JSON-serialized Update. In case of an unsuccessful request (a request with response
     * HTTP status code different from 2XY), we will repeat the request and give up after a reasonable
     * amount of attempts. Returns True on success.
     * If you'd like to make sure that the webhook was set by you, you can specify secret data in the
     * parameter secret_token. If specified, the request will contain a header
     * "X-Telegram-Bot-Api-Secret-Token" with the secret token as content.
     *
     * @param string $url HTTPS URL to send updates to. Use an empty string to remove webhook integration.
     * @param \Telegram\Builders\InputFile|null $certificate Optional. Upload your public key certificate
     *        so that the root certificate in use can be checked. See our self-signed guide for details.
     * @param string|null $ip_address Optional. The fixed IP address which will be used to send webhook
     *        requests instead of the IP address resolved through DNS
     * @param int|null $max_connections Optional. The maximum allowed number of simultaneous HTTPS
     *        connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the
     *        load on your bot's server, and higher values to increase your bot's throughput.
     * @param list<string>|null $allowed_updates Optional. A JSON-serialized list of the update types you
     *        want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"]
     *        to only receive updates of these types. See Update for a complete list of available update types.
     *        Specify an empty list to receive all update types except chat_member, message_reaction, and
     *        message_reaction_count (default). If not specified, the previous setting will be used. Please note
     *        that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted
     *        updates may be received for a short period of time.
     * @param bool|null $drop_pending_updates Optional. Pass True to drop all pending updates
     * @param string|null $secret_token Optional. A secret token to be sent in a header
     *        "X-Telegram-Bot-Api-Secret-Token" in every webhook request, 1-256 characters. Only characters A-Z,
     *        a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook
     *        set by you.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     */
    public function setWebhook(
        string $url,
        ?\Telegram\Builders\InputFile $certificate = null,
        ?string $ip_address = null,
        ?int $max_connections = null,
        ?array $allowed_updates = null,
        ?bool $drop_pending_updates = null,
        ?string $secret_token = null,
    ): PromiseInterface {
        return $this->callApi('setWebhook', get_defined_vars(), ['Boolean']);
    }
}
