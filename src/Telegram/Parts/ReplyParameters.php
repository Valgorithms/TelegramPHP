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
 * Describes reply parameters for the message that is being sent.
 *
 * @property int|null                                                        $message_id Optional. Identifier of the message that will be replied to in the current chat, or in the chat chat_id if it is specified. Required if ephemeral_message_id isn't specified.
 * @property int|string|null                                                 $chat_id Optional. If the message to be replied to is from a different chat, unique identifier for the chat or username of the bot, supergroup or channel in the format @username. Not supported for messages sent on behalf of a business account, messages from channel direct messages chats and ephemeral messages.
 * @property int|null                                                        $ephemeral_message_id Optional. Identifier of the incoming ephemeral message that will be replied to in the current chat. A reply to an ephemeral message must itself be an ephemeral message. An ephemeral message may only be replied to within 15 seconds of being sent. Required if message_id isn't specified.
 * @property bool|null                                                       $allow_sending_without_reply Optional. Pass True if the message should be sent even if the specified message to be replied to is not found. Always False for replies in another chat or forum topic, and sent ephemeral messages. Always True for messages sent on behalf of a business account.
 * @property string|null                                                     $quote Optional. Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities. The message will fail to send if the quote isn't found in the original message. Ignored for ephemeral messages.
 * @property string|null                                                     $quote_parse_mode Optional. Mode for parsing entities in the quote. See formatting options for more details.
 * @property \Discord\Helpers\Collection<\Telegram\Parts\MessageEntity>|null $quote_entities Optional. A JSON-serialized list of special entities that appear in the quote. It can be specified instead of quote_parse_mode.
 * @property int|null                                                        $quote_position Optional. Position of the quote in the original message in UTF-16 code units
 * @property int|null                                                        $checklist_task_id Optional. Identifier of the specific checklist task to be replied to
 * @property string|null                                                     $poll_option_id Optional. Persistent identifier of the specific poll option to be replied to
 *
 * @link https://core.telegram.org/bots/api#replyparameters
 *
 * @since v10.3
 */
class ReplyParameters extends Part
{
    /** @var list<string> */
    protected array $fillable = [
        'message_id',
        'chat_id',
        'ephemeral_message_id',
        'allow_sending_without_reply',
        'quote',
        'quote_parse_mode',
        'quote_entities',
        'quote_position',
        'checklist_task_id',
        'poll_option_id',
    ];

    /** @var array<string, string> */
    protected array $casts = [
        'chat_id'        => 'Integer',
        'quote_entities' => 'Array of MessageEntity',
    ];
}
