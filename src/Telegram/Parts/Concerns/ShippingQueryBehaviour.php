<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Parts\Concerns;

use React\Promise\PromiseInterface;

/**
 * Quoting delivery for an order that asked for a shipping address.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait ShippingQueryBehaviour
{
    /**
     * Offers shipping options, or explains why delivery is not possible.
     *
     * @param list<array<string, mixed>|\JsonSerializable>|null $options Shipping options, when accepting.
     *
     * @return PromiseInterface<bool>
     */
    public function answer(bool $ok = true, ?array $options = null, ?string $errorMessage = null): PromiseInterface
    {
        return $this->telegram->request('answerShippingQuery', [
            'shipping_query_id' => $this->id,
            'ok' => $ok,
            'shipping_options' => $options,
            'error_message' => $errorMessage,
        ], ['Boolean']);
    }
}
