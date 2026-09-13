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
use Telegram\Parts\ChatMember;
use Telegram\Parts\User;

/**
 * The users this client has seen in an update - `$telegram->users`.
 *
 * The Bot API has no "get user" call: a bot only ever learns about a user by
 * being told about them. {@see fetch()} therefore resolves a *membership* -
 * `getChatMember` against a chat the bot is in - and caches the user it carries;
 * {@see get()} answers from what updates have already brought in.
 *
 * @extends AbstractRepository<User>
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
class UserRepository extends AbstractRepository
{
    protected string $part = User::class;

    /**
     * Not supported: the Bot API exposes no way to look a user up by id alone.
     * Use {@see fetchMember()} with a chat the bot shares with them, or read the
     * user off the update that mentioned them.
     *
     * @return PromiseInterface<User>
     *
     * @throws \BadMethodCallException Always.
     */
    public function fetch(int|string $id): PromiseInterface
    {
        throw new \BadMethodCallException(
            'The Bot API cannot look up a user by id. Call fetchMember($chatId, $userId), or read the user from an update.',
        );
    }

    /**
     * Looks the user up as a member of a chat the bot is in, caching the {@see User}
     * the membership carries.
     *
     * @return PromiseInterface<ChatMember>
     */
    public function fetchMember(int|string $chatId, int $userId): PromiseInterface
    {
        return $this->telegram->getChatMember($chatId, $userId)->then(function (ChatMember $member): ChatMember {
            if (($user = $member->user) instanceof User) {
                $this->cache($user);
            }

            return $member;
        });
    }
}
