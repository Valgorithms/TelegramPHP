<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Repository;

use React\Promise\PromiseInterface;
use Telegram\Parts\Chat;
use Telegram\Parts\ChatFullInfo;

/**
 * The chats this client has seen in an update or looked up - `$telegram->chats`.
 *
 * Entries arrive as {@see Chat} stubs off incoming updates and are upgraded in
 * place to the full {@see ChatFullInfo} whenever {@see fetch()} runs, so a cached
 * chat gains attributes over time rather than being replaced.
 *
 * @extends AbstractRepository<Chat>
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class ChatRepository extends AbstractRepository
{
    protected string $part = Chat::class;

    /**
     * Looks a chat up with `getChat`.
     *
     * @param int|string $id A chat id, or an `@channelusername`.
     *
     * @return PromiseInterface<ChatFullInfo>
     */
    public function fetch(int|string $id): PromiseInterface
    {
        return $this->telegram->getChat($id)->then(function (ChatFullInfo $chat): ChatFullInfo {
            /** @var ChatFullInfo $cached */
            $cached = $this->cache($chat);

            return $cached;
        });
    }

    /**
     * The number of members in a chat, which the Bot API answers without handing
     * back a chat object.
     *
     * @return PromiseInterface<int>
     */
    public function countMembers(int|string $id): PromiseInterface
    {
        return $this->telegram->getChatMemberCount($id);
    }
}
