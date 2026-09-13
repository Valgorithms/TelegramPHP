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
 * Confirming a checkout. Telegram gives the bot ten seconds to answer, and
 * abandons the payment if nothing comes back.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait PreCheckoutQueryBehaviour
{
    /**
     * Confirms the order, or explains to the buyer why it cannot go through.
     *
     * @return PromiseInterface<bool>
     */
    public function answer(bool $ok = true, ?string $errorMessage = null): PromiseInterface
    {
        return $this->telegram->request('answerPreCheckoutQuery', [
            'pre_checkout_query_id' => $this->id,
            'ok' => $ok,
            'error_message' => $errorMessage,
        ], ['Boolean']);
    }
}
