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

use Telegram\Parts\InaccessibleMessage;
use Telegram\Parts\Message;

/**
 * `MaybeInaccessibleMessage` is the one union Telegram tags with a value rather
 * than a type: a `date` of 0 means the message is inaccessible to the bot, and
 * anything else is an ordinary message. Attribute shape cannot tell the two
 * apart - an inaccessible message carries a subset of a real one's fields - so
 * the generated resolver is replaced with the documented rule.
 *
 * @link https://core.telegram.org/bots/api#maybeinaccessiblemessage
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait MaybeInaccessibleMessageBehaviour
{
    /**
     * @param array<string, mixed> $attributes
     *
     * @return class-string<\Telegram\Parts\Part>
     */
    public static function resolveSubtype(array $attributes): string
    {
        return ($attributes['date'] ?? null) === 0 ? InaccessibleMessage::class : Message::class;
    }
}
