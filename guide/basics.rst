======
Basics
======

The client
==========

``Telegram\Telegram`` is the object everything hangs off. It owns the HTTP transport, the part
factory, the caches, and the update source, and it is an
`event emitter <https://github.com/igorw/evenement>`_.

.. code-block:: php

   use Telegram\Telegram;

   $telegram = new Telegram([
       'token' => getenv('TELEGRAM_TOKEN'),
   ]);

Options are validated on construction, so a typo in an option name is an exception at startup rather
than a setting that silently does nothing.

Options
=======

.. list-table::
   :header-rows: 1

   * - Option
     - Default
     - Description
   * - ``token``
     - *required*
     - The token from @BotFather.
   * - ``loop``
     - the shared loop
     - The ReactPHP event loop to run on. Pass your own to share it with other services.
   * - ``logger``
     - ``NullLogger``
     - A PSR-3 logger. Set it to see every request the client makes.
   * - ``base_url``
     - ``https://api.telegram.org``
     - Point this at a `local Bot API server <https://core.telegram.org/bots/api#using-a-local-bot-api-server>`_.
   * - ``socket_options``
     - ``[]``
     - Passed to ``React\Socket\Connector``. Needed on Windows - see :doc:`faq`.
   * - ``poll_timeout``
     - ``50``
     - Seconds ``getUpdates`` holds the connection open waiting for something to happen.
   * - ``poll_limit``
     - ``100``
     - Maximum updates per round.
   * - ``allowed_updates``
     - ``null``
     - Update types to receive. ``null`` keeps Telegram's default, which excludes a few noisy ones.
   * - ``drop_pending_updates``
     - ``false``
     - Skip the backlog that queued up while the bot was offline.
   * - ``webhook``
     - -
     - Listen for deliveries instead of polling. See :doc:`webhooks`.
   * - ``http`` / ``driver``
     - -
     - Replace the transport or its driver outright. Mostly useful in tests.

Logging
=======

The client says nothing by default. Give it a PSR-3 logger to see what it is doing:

.. code-block:: php

   use Monolog\Handler\StreamHandler;
   use Monolog\Logger;

   $logger = new Logger('telegram');
   $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

   $telegram = new Telegram(['token' => $token, 'logger' => $logger]);

At ``DEBUG`` every request is logged as it goes out, including retries. At ``INFO`` you get the login
line and little else. Rate limiting and failed rounds are logged at ``WARNING``.

Running
=======

``run()`` starts the bot and runs the event loop, which blocks until the loop is stopped:

.. code-block:: php

   $telegram->run();

If the bot shares a loop with other ReactPHP services, start it without taking over the loop and run
the loop yourself:

.. code-block:: php

   $telegram->run(false);
   // ... start your other services ...
   Loop::get()->run();

``start()`` does the same as ``run(false)`` and hands back a promise that resolves with the bot's own
``User`` once ``getMe`` has answered:

.. code-block:: php

   $telegram->start()->then(function (User $me) {
       echo 'Logged in as @', $me->username, PHP_EOL;
   });

Stopping
========

.. code-block:: php

   $telegram->stop();      // stop receiving updates; the loop keeps running
   $telegram->shutdown();  // stop receiving updates and stop the loop

.. note::

   It is ``shutdown()``, not ``close()``, because ``close`` is a Bot API method of its own - it
   releases the bot from Telegram's servers before you move it to a local Bot API server - and the
   generated method needs that name.

Events
======

``ready`` fires once the bot has identified itself and updates are flowing; ``error`` carries
anything the client could not hand to a caller, including exceptions thrown by your own handlers.

.. code-block:: php

   use Telegram\Events\Event;

   $telegram->on(Event::READY, function (Telegram $telegram) {
       echo 'Logged in as @', $telegram->getBotUser()->username, PHP_EOL;
   });

   $telegram->on(Event::ERROR, function (Throwable $e) {
       echo 'error: ', $e->getMessage(), PHP_EOL;
   });

Everything else is an update type - see :doc:`events`.

Accessors
=========

.. code-block:: php

   $telegram->getBotUser();   // the bot's own User, once ready
   $telegram->isReady();      // has getMe answered?
   $telegram->getLoop();      // the event loop
   $telegram->getLogger();    // the PSR-3 logger
   $telegram->getHttp();      // the transport
   $telegram->getFactory();   // builds parts from raw payloads
   $telegram->getPoller();    // the long-polling loop, when polling
   $telegram->getWebhookServer();
