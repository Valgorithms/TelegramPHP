.. _events:

====================
Updates and events
====================

An *update* is Telegram telling your bot that something happened. Whether they arrive by long polling
or by webhook, they reach your code the same way: as events.

Each update is emitted twice - once as ``Event::UPDATE`` carrying the whole ``Update`` part, and once
under its own type carrying just that payload. The second form is what most handlers want:

.. code-block:: php

   use Telegram\Events\Event;
   use Telegram\Parts\CallbackQuery;
   use Telegram\Parts\Message;

   $telegram->on(Event::MESSAGE, function (Message $message) {
       // a new message of any kind
   });

   $telegram->on(Event::CALLBACK_QUERY, function (CallbackQuery $query) {
       // someone pressed an inline button
   });

   $telegram->on(Event::UPDATE, function (Update $update) {
       // every update, whatever its type
   });

Handlers also receive the client as a second argument, so a static closure can still reach it:

.. code-block:: php

   $telegram->on(Event::MESSAGE, static function (Message $message, Telegram $telegram) {
       $telegram->sendChatAction($message->chat->id, 'typing');
   });

The update types
================

The constants on ``Telegram\Events\Event`` are generated from the ``Update`` object itself, so they
are exactly the types this Bot API version defines:

.. include:: _generated/update-types.rst

That table is generated from the spec along with the constants themselves, so it lists exactly what
this build supports. The same information is available at runtime:

.. code-block:: php

   Event::all();            // ['message', 'edited_message', 'channel_post', ...]
   Event::PAYLOAD_TYPES;    // ['message' => 'Message', 'callback_query' => 'CallbackQuery', ...]

Choosing what to receive
========================

Telegram withholds some update types unless you ask for them - ``chat_member`` and the reaction types
among them - and sends everything else whether you use it or not. Asking for only what you handle
cuts both traffic and the work of hydrating payloads you throw away:

.. code-block:: php

   $telegram = new Telegram([
       'token' => $token,
       'allowed_updates' => [Event::MESSAGE, Event::CALLBACK_QUERY, Event::CHAT_MEMBER],
   ]);

The same list goes to ``setWebhook`` when you are using one.

.. warning::

   ``allowed_updates`` is remembered by Telegram between calls. Passing ``null`` keeps whatever was
   set last rather than resetting it - pass an explicit list to change it.

Long polling
============

Polling is the default and needs no public address. Each round calls ``getUpdates`` with a timeout, so
the connection is held open until Telegram has something to say. Updates are acknowledged by the
*next* round asking for everything past the highest ``update_id`` handled, which means an update your
handler threw on is not redelivered - it is logged and emitted as ``Event::ERROR`` instead.

.. code-block:: php

   $telegram = new Telegram([
       'token' => $token,
       'poll_timeout' => 50,          // seconds to hold the connection open
       'poll_limit' => 100,           // updates per round
       'drop_pending_updates' => true, // ignore the backlog from while the bot was down
   ]);

A failed round backs off - one second, then two, four, up to thirty - rather than hammering a server
that is already unhappy, and a ``retry_after`` from Telegram is honoured exactly. The poller is
reachable while it runs:

.. code-block:: php

   $telegram->getPoller()->getOffset();    // the update_id the next round asks from
   $telegram->getPoller()->isRunning();

.. note::

   Only one poller may hold a token at a time, and a webhook excludes polling entirely. A second one
   gets a ``409 Conflict`` - see :doc:`errors`.

Handlers that throw
===================

An exception out of your handler does not stop the bot. It is logged, emitted as ``Event::ERROR``,
and the next update is processed:

.. code-block:: php

   $telegram->on(Event::ERROR, function (Throwable $e, Telegram $telegram) {
       $logger->error('handler failed', ['exception' => $e]);
   });

This applies to exceptions thrown *synchronously*. A rejected promise inside a handler is not an
exception anyone sees unless you handle it - see :doc:`errors`.
