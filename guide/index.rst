.. toctree::
   :hidden:

   index
   basics
   calling
   events
   parts
   builders
   commands
   webhooks
   errors
   caches
   generated
   faq

=====
Guide
=====

TelegramPHP is an async wrapper for the `Telegram Bot API <https://core.telegram.org/bots/api>`_,
built on `ReactPHP <https://reactphp.org/>`_ components and shaped like
`DiscordPHP <https://github.com/discord-php/DiscordPHP>`_: a non-blocking HTTP transport, an
event-emitting client, hydrated *parts* for every API object, and repositories that cache what the
bot has seen.

Its API surface is generated from the Bot API specification rather than written by hand, so every
method and every field the documentation describes is present, correctly typed, and covered by a
test. See :doc:`generated` for how that works and what it means when Telegram ships a new version.

This documentation is built from the ``dev`` branch and describes **Bot API 10.3**.

Requirements
============

- `PHP 8.4 <https://php.net>`_ or higher

  + Will not run on a webserver (FPM, CGI) in polling mode - you must run through CLI, because a bot
    is a long-running process. Webhook mode is the exception: see :doc:`webhooks`.

- ``ext-json`` for JSON parsing.
- ``ext-mbstring`` for accurate string lengths when handling non-English text.

Recommended Extensions
----------------------

- One of ``ext-uv``, ``ext-ev`` or ``ext-event`` (in order of preference) for a faster, more
  performant event loop.
- ``ext-fileinfo`` so uploads can guess their own MIME type.

Development Environment Recommendations
---------------------------------------

Every generated method carries the Bot API's own documentation in its docblock, and every part
declares its attributes as ``@property`` tags, so an editor with good PHP support will tell you what
a method takes and what an object holds without leaving the file. We recommend an editor with
support for the `Language Server Protocol <https://microsoft.github.io/language-server-protocol/>`_
and `PHP Intelephense <https://intelephense.com/>`_; the free version is enough.

Installation
============

Installation requires `Composer <https://getcomposer.org>`_.

To install the latest release::

   $ composer require vzgcoders/telegramphp

If you would like to run on the latest ``dev`` branch::

   $ composer require vzgcoders/telegramphp dev-dev

Getting a token
===============

Message `@BotFather <https://t.me/BotFather>`_ on Telegram, send ``/newbot``, and follow the prompts.
It answers with a token that looks like ``123456789:AAEhBOweik6ad9r_QXqvdvvcs``. That token *is* the
bot's identity - anyone holding it can act as your bot - so keep it out of version control. Put it in
an environment variable or a ``.env`` file that is git-ignored.

Your first bot
==============

.. code-block:: php

   <?php

   require 'vendor/autoload.php';

   use Telegram\Events\Event;
   use Telegram\Parts\Message;
   use Telegram\Telegram;

   $telegram = new Telegram(['token' => getenv('TELEGRAM_TOKEN')]);

   $telegram->on(Event::MESSAGE, function (Message $message) {
       if ($message->text === 'ping') {
           $message->reply('pong');
       }
   });

   $telegram->run();

Run it from the CLI. The client identifies itself with ``getMe``, starts long polling, and emits
:ref:`events <events>` as updates arrive.

Key tips
========

Nothing blocks. Every API call returns a `promise <https://reactphp.org/promise/>`_ that resolves
with the hydrated result, and the event loop keeps running while calls are in flight. Code that
blocks the loop - ``sleep()``, a synchronous database driver, a long ``file_get_contents()`` over the
network - stops the bot from receiving anything until it returns. This is the single most common
cause of a bot that "randomly stops responding".

A bot is only told about what concerns it. In private chats it sees everything; in groups, Telegram's
*privacy mode* limits it to commands and replies addressed to it until you turn that off through
@BotFather. See :doc:`faq`.

Help
====

Questions and bug reports are welcome in the
`GitHub repository <https://github.com/Valgorithms/TelegramPHP>`_.

Contributing
============

Pull requests are welcome. Note that the parts under ``src/Telegram/Parts`` and the API methods under
``src/Telegram/Api`` are **generated** - a change there will be overwritten. :doc:`generated` explains
where to make the change instead.
