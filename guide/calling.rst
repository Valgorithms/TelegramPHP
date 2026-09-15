================
Calling the API
================

Every Bot API method is a real method on the client, named exactly as Telegram names it, taking
exactly the fields Telegram documents. Required fields are positional, in the order the documentation
lists them; everything else is a named argument.

.. code-block:: php

   $telegram->sendMessage($chatId, 'Deploying now');

   $telegram->sendMessage($chatId, '<b>Deploying now</b>',
       parse_mode: 'HTML',
       disable_notification: true,
       reply_parameters: ['message_id' => $message->message_id],
   );

Because the arguments are named rather than a single options array, an editor completes them, a typo
is a fatal error rather than a field Telegram silently ignores, and the docblock on each method is
the Bot API's own description of what it does.

Promises
========

Nothing blocks. Every call returns a ``React\Promise\PromiseInterface`` that resolves with the result
already turned into :doc:`parts <parts>`:

.. code-block:: php

   use Telegram\Parts\Message;

   $telegram->sendMessage($chatId, 'hello')->then(function (Message $sent) {
       echo 'sent as message ', $sent->message_id, PHP_EOL;
   });

Chain calls rather than nesting them, and always handle the rejection - a promise whose failure
nobody handles is a bug that will not announce itself:

.. code-block:: php

   $telegram->sendMessage($chatId, 'working on it')
       ->then(fn (Message $sent) => $telegram->pinChatMessage($chatId, $sent->message_id))
       ->then(
           fn () => print("pinned\n"),
           fn (Throwable $e) => print("failed: {$e->getMessage()}\n"),
       );

See :doc:`errors` for what those rejections are.

Results
=======

What a call resolves with follows what the Bot API says it returns:

.. list-table::
   :header-rows: 1

   * - Telegram says
     - You get
   * - ``Message``
     - a ``Telegram\Parts\Message``
   * - ``Array of Update``
     - a ``Discord\Helpers\Collection`` of ``Update`` parts
   * - ``True``
     - ``true``
   * - ``String``, ``Integer``
     - the scalar
   * - ``Message`` *or* ``True``
     - whichever actually came back

That last row is the interesting one. ``editMessageText`` answers with the edited message when the
bot can see it, and with ``true`` when the message is an inline one it cannot read back. The client
hydrates whichever shape arrived, so a handler can simply check:

.. code-block:: php

   $telegram->editMessageText('done', chat_id: $chatId, message_id: $id)
       ->then(function (Message|bool $result) {
           if ($result instanceof Message) {
               // the edited message
           }
       });

Awaiting a result
=================

In a script that is not itself a bot - a one-off task, a test - ``React\Async\await()`` turns a
promise into a return value:

.. code-block:: php

   use function React\Async\await;

   $me = await($telegram->getMe());
   echo $me->username;

Never use it inside an event handler of a running bot: it runs the loop re-entrantly and will
deadlock against the call you are already inside.

Files
=====

Any field the documentation types as ``InputFile or String`` takes either. Pass a string to reuse a
``file_id`` or point Telegram at a URL; pass an ``InputFile`` to upload, and the request becomes a
``multipart/form-data`` upload automatically:

.. code-block:: php

   use Telegram\Builders\InputFile;

   $telegram->sendPhoto($chatId, 'AgACAgQAAxkBAA...');           // an existing file_id
   $telegram->sendPhoto($chatId, 'https://example.com/cat.jpg'); // a URL Telegram fetches
   $telegram->sendPhoto($chatId, InputFile::fromPath('cat.jpg'));// an upload

See :doc:`builders` for the details, including files nested inside media groups.

Methods this build has not heard of
===================================

The generated methods describe one Bot API version. If you are pointed at a server that is ahead of
it, or a local Bot API server with an extension of its own, call it by name:

.. code-block:: php

   $telegram->request('someFutureMethod', ['chat_id' => $chatId], ['Message']);

The third argument is the Telegram type the result should be hydrated as; leave it out to get the raw
decoded value. Everything else - encoding, uploads, rate limiting, error mapping - works the same.

The endpoint list
=================

``Telegram\Http\Endpoint`` holds every method name as a constant, which is useful when a method name
is passed around rather than called directly:

.. code-block:: php

   use Telegram\Http\Endpoint;

   Endpoint::SEND_MESSAGE;   // 'sendMessage'
   Endpoint::all();          // every method this build knows about
