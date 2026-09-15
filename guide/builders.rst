=======================
Keyboards and files
=======================

Inline keyboards
================

An inline keyboard is the row of buttons that stays attached to a message. ``InlineKeyboard`` builds
the markup; buttons go into the current row, and ``row()`` starts the next one:

.. code-block:: php

   use Telegram\Builders\InlineKeyboard;

   $telegram->sendMessage($chatId, 'Deploy?', reply_markup: InlineKeyboard::new()
       ->callback('Ship it', 'deploy:yes')
       ->callback('Hold', 'deploy:no')
       ->row()
       ->url('What changed', 'https://example.com/diff'));

The button kinds:

.. code-block:: php

   InlineKeyboard::new()
       ->callback('Press me', 'some:data')          // sends a callback query back
       ->url('Open a link', 'https://example.com')
       ->webApp('Open the app', 'https://example.com/app')
       ->login('Sign in', 'https://example.com/login')
       ->switchInline('Share', 'a query')           // picks a chat to drop the query into
       ->switchInline('Here', 'a query', currentChat: true)
       ->copyText('Copy the code', 'ABC-123')
       ->game('Play')                               // first button only
       ->pay('Pay')                                 // first button only, invoices only
       ->button(['text' => 'Anything else', 'callback_data' => 'raw']);

Pressing a ``callback`` button produces a ``callback_query`` update. **Answer every one**, even with
nothing to say, or the button spins on the user's screen until it times out:

.. code-block:: php

   $telegram->on(Event::CALLBACK_QUERY, function (CallbackQuery $query) {
       $query->answer();                     // stops the spinner
       $query->editMessage('Deployed. 🚀');  // replaces the message the button is under
   });

Callback data is limited to 64 bytes, so put an identifier in it rather than a payload.

Reply keyboards
===============

A reply keyboard replaces the user's own keyboard with buttons that send text or ask for something:

.. code-block:: php

   use Telegram\Builders\ReplyKeyboard;

   $telegram->sendMessage($chatId, 'Where are you?', reply_markup: ReplyKeyboard::new()
       ->requestLocation('Send my location')
       ->row()
       ->button('Skip')
       ->resize()
       ->oneTime());

.. code-block:: php

   ReplyKeyboard::new()
       ->button('Plain text')
       ->requestContact('Share my number')      // private chats only
       ->requestLocation('Share my location')   // private chats only
       ->requestPoll('Make a poll', 'quiz')
       ->webApp('Open the app', 'https://example.com/app')
       ->requestUsers('Pick people', requestId: 1, criteria: ['max_quantity' => 3])
       ->requestChat('Pick a channel', requestId: 2, chatIsChannel: true)
       ->resize()          // shrink to fit the buttons
       ->oneTime()         // hide after one press
       ->persistent()      // keep it open
       ->placeholder('Pick one')
       ->selective();      // show only to the users the message concerns

The two markups that carry no buttons are static helpers:

.. code-block:: php

   $telegram->sendMessage($chatId, 'Done', reply_markup: ReplyKeyboard::remove());
   $telegram->sendMessage($chatId, 'Your name?', reply_markup: ReplyKeyboard::forceReply('Type it here'));

Uploading files
===============

Anywhere the Bot API types a field as ``InputFile or String`` you have three choices, and only the
last one is an upload:

.. code-block:: php

   use Telegram\Builders\InputFile;

   $telegram->sendPhoto($chatId, 'AgACAgQAAxkBAA...');            // a file_id Telegram already has
   $telegram->sendPhoto($chatId, 'https://example.com/cat.jpg');  // a URL Telegram fetches itself
   $telegram->sendPhoto($chatId, InputFile::fromPath('cat.jpg')); // bytes from this machine

Reuse a ``file_id`` whenever you can - it costs Telegram nothing and you nothing.

An ``InputFile`` can come from disk, from memory, or from a stream:

.. code-block:: php

   InputFile::fromPath('/tmp/report.pdf');                       // name and type guessed
   InputFile::fromPath('/tmp/x.bin', 'report.pdf', 'application/pdf');
   InputFile::fromString($csv, 'report.csv', 'text/csv');
   InputFile::fromStream($handle, 'report.csv');

Passing one anywhere in the payload switches that request to ``multipart/form-data`` - you do not
have to say so. That holds at any depth, which is what makes media groups work:

.. code-block:: php

   $telegram->sendMediaGroup($chatId, [
       ['type' => 'photo', 'media' => InputFile::fromPath('one.jpg'), 'caption' => 'First'],
       ['type' => 'photo', 'media' => InputFile::fromPath('two.jpg')],
   ]);

A nested file is sent as its own form part and its place in the JSON is replaced with an
``attach://`` reference, exactly as the Bot API requires. A top-level file field is sent as that field
directly.

.. note::

   The official Bot API server accepts uploads up to 50 MB (10 MB for photos). Point ``base_url`` at a
   `local Bot API server <https://core.telegram.org/bots/api#using-a-local-bot-api-server>`_ to lift
   that to 2 GB.

Downloading files
=================

An incoming file is a ``file_id`` plus metadata; the bytes take a second call. Either do it in one
step from the client, or in two if you want the ``File`` record:

.. code-block:: php

   $telegram->downloadFile($message->document->file_id)
       ->then(fn (string $bytes) => file_put_contents('report.pdf', $bytes));

   $telegram->getFile($message->document->file_id)
       ->then(fn (File $file) => $file->save('/tmp'));   // keeps Telegram's own filename

.. warning::

   ``File::getUrl()`` contains the bot token, because that is how Telegram authorises the download.
   Never log it or hand it to a user - it is as sensitive as the token itself.

A ``file_path`` is valid for at least an hour. After that, call ``getFile`` again with the same
``file_id``.
