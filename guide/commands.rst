========
Commands
========

``TelegramCommandClient`` is a ``Telegram`` client that routes slash commands - the counterpart of
DiscordPHP's ``DiscordCommandClient``. It is a drop-in replacement, so everything in the rest of this
guide still applies.

.. code-block:: php

   use Telegram\CommandClient\TelegramCommandClient;
   use Telegram\Parts\Message;

   $bot = new TelegramCommandClient([
       'token' => getenv('TELEGRAM_TOKEN'),
       'description' => 'A helpful bot',
   ]);

   $bot->registerCommand('ping', fn () => 'pong', [
       'description' => 'Checks the bot is alive',
   ]);

   $bot->run();

Callbacks
=========

A callback receives the message that triggered it, the arguments after the command word, and the
client:

.. code-block:: php

   $bot->registerCommand('echo', function (Message $message, array $args, TelegramCommandClient $bot) {
       return implode(' ', $args);
   });

Returning a string sends it back as a reply. Return anything else - including nothing - and the client
stays quiet, which is what you want when the command answers for itself:

.. code-block:: php

   $bot->registerCommand('deploy', function (Message $message) use ($bot) {
       $bot->sendChatAction($message->chat->id, 'typing');

       $message->reply('Deploying...', ['reply_markup' => InlineKeyboard::new()
           ->callback('Cancel', 'deploy:cancel')]);
   });

An exception out of a callback is logged and emitted as ``Event::ERROR`` rather than ending the bot.

Options
=======

.. code-block:: php

   $bot->registerCommand('status', fn () => 'green', [
       'description' => 'Reports the current status',  // shown in /help and the command menu
       'aliases' => ['st', 'stat'],                    // other words that trigger it
       'listed' => false,                              // hide it from /help and the menu
   ]);

Client options, on top of the ones in :doc:`basics`:

.. list-table::
   :header-rows: 1

   * - Option
     - Default
     - Description
   * - ``prefix``
     - ``/``
     - What a command starts with. ``!`` and ``.`` are common alternatives.
   * - ``description``
     - ``''``
     - Shown at the top of ``/help``.
   * - ``register_commands``
     - ``true``
     - Publish the listed commands with ``setMyCommands`` once the bot is ready.
   * - ``help_command``
     - ``help``
     - Name of the built-in help command. ``null`` disables it.
   * - ``case_insensitive``
     - ``true``
     - Match ``/Ping`` as ``/ping``.

Addressing
==========

In a group, commands are usually written ``/command@yourbot`` so several bots can coexist. The client
accepts both forms, and ignores a command addressed to a different bot:

.. code-block:: text

   /ping          -> handled
   /ping@yourbot  -> handled
   /ping@otherbot -> ignored

That check needs the bot's own username, which it learns at startup, so it only applies once the
client is ready.

The command menu
================

With ``register_commands`` left on, the listed commands are published to Telegram on ``ready``, which
is what fills the menu beside the message box in every client:

.. code-block:: php

   $bot->publishCommands();   // or do it yourself, whenever

Only commands with ``listed => true`` (the default) are published, and their ``description`` is what
users see. Publishing replaces the whole menu, so it reflects exactly what the running build
registers.

Help
====

``/help`` is registered for you and lists the description followed by every listed command. Turn it
off with ``help_command => null`` and register your own if you would rather write it yourself.

Managing commands
=================

.. code-block:: php

   $bot->getCommand('ping');       // the Command, or null
   $bot->getCommands();            // name => Command, for every registered command
   $bot->unregisterCommand('ping'); // forgets it, aliases included

Registering the same name twice is an ``InvalidArgumentException`` rather than a silent overwrite.

Beyond slash commands
=====================

Telegram has no equivalent of Discord's application commands - a slash command is an ordinary message
that happens to start with ``/``, and the published menu is only a hint to the client. Anything you
can do with a message, you can do with a command, and anything the command client does you could
write by hand on ``Event::MESSAGE``.
