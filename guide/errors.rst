================
Handling errors
================

A call that Telegram refuses rejects its promise with a subclass of
``Telegram\Http\Exceptions\HttpException``, chosen by the error code and carrying what Telegram
actually said.

.. code-block:: php

   use Telegram\Http\Exceptions\ForbiddenException;
   use Telegram\Http\Exceptions\HttpException;

   $telegram->sendMessage($chatId, 'hello')->then(
       fn (Message $sent) => $logger->info("sent {$sent->message_id}"),
       function (HttpException $e) use ($logger) {
           if ($e instanceof ForbiddenException) {
               // blocked by the user, or kicked from the chat - stop trying
               return;
           }

           $logger->error($e->getMessage(), ['code' => $e->getErrorCode()]);
       },
   );

.. warning::

   A rejection nobody handles is silent. If a call can fail in a way you care about - and sending can
   always fail - attach a rejection handler.

The exceptions
==============

.. list-table::
   :header-rows: 1

   * - Code
     - Exception
     - Usually means
   * - 400
     - ``BadRequestException``
     - The chat, message, or file does not exist, or the request is malformed.
   * - 401
     - ``UnauthorizedException``
     - The token is wrong, revoked, or missing.
   * - 403
     - ``ForbiddenException``
     - Blocked by the user, kicked from the chat, or missing a right.
   * - 404
     - ``NotFoundException``
     - No such Bot API method - a typo, or one newer than the server.
   * - 409
     - ``ConflictException``
     - Another poller or a webhook already owns this token's updates.
   * - 413
     - ``RequestEntityTooLargeException``
     - The upload is over the server's limit.
   * - 429
     - ``TooManyRequestsException``
     - Rate limited, and the client has already exhausted its retries.
   * - 5xx
     - ``ServerException``
     - Telegram is unwell. The client already retried.

All of them carry the detail:

.. code-block:: php

   $e->getMessage();          // 'Bad Request: chat not found'
   $e->getErrorCode();        // 400
   $e->getParameters();       // the response's `parameters` object
   $e->getRetryAfter();       // seconds, on a 429
   $e->getMigrateToChatId();  // the supergroup a migrated group became
   $e->getResponse();         // the PSR-7 response, if you need the rest

Rate limits
===========

Telegram's limits are per bot and not published exactly; roughly, about one message per second to a
given chat and around thirty per second overall, with lower limits for groups.

The client handles a ``429`` for you: the whole queue is held for exactly the ``retry_after`` Telegram
asked for, then the request is replayed, up to four attempts. Racing ahead with other calls during
that window would only earn more 429s, so nothing is sent until the hold expires. Only a request still
being refused after the last attempt reaches you, as a ``TooManyRequestsException``.

Transient ``5xx`` and connection failures are retried too, with exponential backoff. You see the
failure only once the client has stopped trying.

Migrated chats
==============

When a group is upgraded to a supergroup its id changes, and calls against the old one fail with a
``400`` that names the new id. It is worth handling if you store chat ids:

.. code-block:: php

   function (BadRequestException $e) use ($telegram, $text) {
       if (($newId = $e->getMigrateToChatId()) !== null) {
           $repository->updateChatId($newId);

           return $telegram->sendMessage($newId, $text);
       }

       throw $e;
   }

Errors from your own code
=========================

Exceptions thrown synchronously inside an update handler are caught, logged, and emitted as
``Event::ERROR`` - one bad update does not stop the bot:

.. code-block:: php

   $telegram->on(Event::ERROR, function (Throwable $e, Telegram $telegram) {
       $logger->error('bot error', ['exception' => $e]);
   });

The same event carries failures the client could not hand to a caller, such as a polling round that
failed. Polling recovers on its own, backing off between attempts; you do not need to restart
anything.

Errors the library raises
=========================

Separate from Telegram's, under ``Telegram\Exceptions``:

- ``TelegramException`` - the base for all of them.
- ``FileNotFoundException`` - ``InputFile::fromPath()`` on something unreadable.
- ``PartException`` - a payload that could not be built into a part.
- ``PollingException`` - the webhook listener could not bind its address.
