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
 * Answering an inline query.
 *
 * @author Valithor Obsidion <valithor@valgorithms.com>
 */
trait InlineQueryBehaviour
{
    /**
     * Answers with up to 50 results.
     *
     * @param list<array<string, mixed>|\JsonSerializable> $results
     * @param array<string, mixed>                         $options Any other `answerInlineQuery` field.
     *
     * @return PromiseInterface<bool>
     */
    public function answer(array $results, array $options = []): PromiseInterface
    {
        return $this->telegram->request('answerInlineQuery', array_merge([
            'inline_query_id' => $this->id,
            'results' => $results,
        ], $options), ['Boolean']);
    }
}
