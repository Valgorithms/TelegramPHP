===
FAQ
===

The bot does not see messages in a group
========================================

Telegram's *privacy mode* is on by default: in groups, a bot is only told about commands, replies to
its own messages, and service messages. Everything else is withheld.

Either address the bot explicitly, or turn privacy mode off through
`@BotFather <https://t.me/BotFather>`_ - ``/mybots`` → your bot → *Bot Settings* → *Group Privacy*.
The change takes effect when the bot is next added to a group, so remove and re-add it to existing
ones. ``getMe`` reports the current state:

.. code-block:: php

   $telegram->getMe()->then(fn (User $me) => var_dump($me->can_read_all_group_messages));

"Conflict: terminated by other getUpdates request"
==================================================

A ``ConflictException`` means something else is already receiving this token's updates - another copy
of your bot, a forgotten process, or a webhook still registered. Only one consumer may hold a token.

.. code-block:: php

   $telegram->deleteWebhook();   // if a webhook is the culprit

Check with ``getWebhookInfo``, and look for a second process before assuming it is Telegram's fault.

TLS fails on Windows
====================

Windows builds of PHP usually ship without a CA bundle, so connecting to ``api.telegram.org`` fails -
often as a bare "Connection lost". Point the connector at a bundle:

.. code-block:: php

   $telegram = new Telegram([
       'token' => $token,
       'socket_options' => ['tls' => ['cafile' => 'C:/php/cacert.pem']],
   ]);

Download one from `curl.se/ca/cacert.pem <https://curl.se/ca/cacert.pem>`_, or set ``openssl.cafile``
in ``php.ini`` and it will be found without the option.

"Forbidden: bot was blocked by the user"
========================================

A bot may only message a user who has started a conversation with it, and the user can block it at
any time. There is no way to undo that from your side, and no way to know in advance - handle the
``ForbiddenException`` and stop sending to that chat.

The bot stops responding after a while
======================================

Almost always something blocking the event loop. ``sleep()``, a synchronous HTTP call, a slow database
driver, a long file read - any of them stop the bot from receiving anything until they return. Use the
async equivalents, and keep handlers short.

If it is not that, turn on a ``DEBUG`` logger and watch: a bot that is polling normally logs a
``getUpdates`` round every ``poll_timeout`` seconds at most.

Nothing happens and no error appears
====================================

A rejected promise that nobody handles is silent. Attach a rejection handler to calls you care about:

.. code-block:: php

   $telegram->sendMessage($chatId, 'hello')->then(null, fn (Throwable $e) => print($e->getMessage()));

Messages arrive out of order, or twice
======================================

Updates are delivered in order, but your own calls are not - eight requests may be in flight at once,
and they complete when they complete. Chain promises where order matters.

A duplicate usually means two consumers of the same token, or a webhook endpoint answering slowly
enough that Telegram retried. See the conflict entry above.

How do I send a message to a chat the bot has never seen?
=========================================================

You need its id, and the Bot API will not look one up by name for a private chat. Store the id when
you first see the user or chat. Public channels and groups can be addressed by ``@username`` instead:

.. code-block:: php

   $telegram->sendMessage('@mychannel', 'hello');

How do I format text?
=====================

Pass ``parse_mode``. ``HTML`` is usually the least painful, because MarkdownV2 requires escaping a
long list of characters:

.. code-block:: php

   $telegram->sendMessage($chatId, '<b>bold</b> <i>italic</i> <code>code</code>', parse_mode: 'HTML');

``User::mention()`` builds a correctly escaped mention for either mode.

Which PHP versions are supported?
=================================

8.4 and newer. The generated methods lean on named arguments and native union types, and the
collection the library hydrates arrays into (``discord-php-helpers/collection``, shared with
DiscordPHP) requires 8.4 itself.

Can I run several bots in one process?
======================================

Yes. Construct several clients with different tokens and pass them the same loop - they share it
without interfering:

.. code-block:: php

   $loop = React\EventLoop\Loop::get();

   $first = new Telegram(['token' => $tokenA, 'loop' => $loop]);
   $second = new Telegram(['token' => $tokenB, 'loop' => $loop]);

   $first->run(false);
   $second->run(false);

   $loop->run();

Is there a local Bot API server mode?
=====================================

Yes - point ``base_url`` at it. That lifts the 50 MB upload limit to 2 GB and lets the bot download
files without going through Telegram's servers:

.. code-block:: php

   $telegram = new Telegram(['token' => $token, 'base_url' => 'http://127.0.0.1:8081']);

A server started with ``--local`` also needs ``local_files``, saying where its files are on this
machine; without it a download fails with an error naming the option. See
:doc:`builders` for the details, and call ``logOut()`` once against Telegram's own server before
the first request to a local one.
