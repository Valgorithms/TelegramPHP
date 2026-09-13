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
 * Approving or declining a request to join a chat.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait ChatJoinRequestBehaviour
{
    /**
     * Lets the user in.
     *
     * @return PromiseInterface<bool>
     */
    public function approve(): PromiseInterface
    {
        return $this->telegram->request('approveChatJoinRequest', [
            'chat_id' => $this->chat?->id,
            'user_id' => $this->from?->id,
        ], ['Boolean']);
    }

    /**
     * Turns the request down.
     *
     * @return PromiseInterface<bool>
     */
    public function decline(): PromiseInterface
    {
        return $this->telegram->request('declineChatJoinRequest', [
            'chat_id' => $this->chat?->id,
            'user_id' => $this->from?->id,
        ], ['Boolean']);
    }
}
