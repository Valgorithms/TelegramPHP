=====
Parts
=====

Every object the Bot API describes has a *part*: a small model class under ``Telegram\Parts`` that
holds the attributes Telegram sent and knows how to turn them back into what Telegram expects. They
are the same idea as DiscordPHP's parts, and there are 400 of them, one per documented type.

You rarely construct one yourself - they arrive from calls and from updates.

Reading attributes
==================

Attributes are readable as properties or as array keys, whichever reads better at the call site:

.. code-block:: php

   $message->message_id;
   $message->chat->title;
   $message['from']['username'];

   isset($message->text);        // false when Telegram omitted it

Attribute names are Telegram's own - ``message_id``, not ``messageId`` - so the documentation and
your code say the same thing. Every part declares its attributes as ``@property`` tags, so an editor
completes them and tells you the type and whether it is optional.

An attribute Telegram did not send is ``null`` rather than an error, which is what makes the optional
fields of ``Message`` bearable:

.. code-block:: php

   if ($message->photo !== null) {
       // a photo message
   }

Nested objects
==============

Nested objects are hydrated into parts, recursively, and arrays of them into a
``Discord\Helpers\Collection``:

.. code-block:: php

   $message->chat;                     // Telegram\Parts\Chat
   $message->from;                     // Telegram\Parts\User
   $message->entities;                 // Collection of MessageEntity
   $message->entities->first()->type;  // 'bold'
   $message->photo->last()->file_id;   // the largest size Telegram made

Timestamps
==========

Fields the Bot API sends as Unix timestamps read back as
`CarbonImmutable <https://carbon.nesbot.com/>`_:

.. code-block:: php

   $message->date->toIso8601String();
   $message->date->diffForHumans();
   $member->until_date?->isPast();

Serialisation keeps the original integer, so a part that goes back to Telegram is byte-identical to
the one that arrived:

.. code-block:: php

   $message->jsonSerialize()['date'];   // 1700000000
   json_encode($message);               // the payload Telegram sent

Union types
===========

A few Bot API types are really a choice between several - ``ChatMember`` is one of six, ``InputMedia``
one of six, ``ReactionType`` one of three. Those are abstract parts, and an incoming payload resolves
to the concrete one:

.. code-block:: php

   use Telegram\Parts\ChatMemberAdministrator;

   $telegram->getChatMember($chatId, $userId)->then(function (ChatMember $member) {
       if ($member instanceof ChatMemberAdministrator) {
           $member->can_delete_messages;
       }

       $member->status;   // 'administrator'
   });

Resolution is by the field Telegram tags the union with - ``status`` here, ``type`` for most others.
A tag this build has never seen, because Telegram added a member since it was generated, resolves to
the closest match by shape rather than failing the whole update.

Behaviour
=========

Parts are not only data. The ones worth acting on carry methods that use the client they came from,
so the ids come off the object instead of out of your variables.

**Message**

.. code-block:: php

   $message->reply('on it');                       // quotes the message
   $message->say('anyone there?');                 // same chat, no quote
   $message->replyWithPhoto(InputFile::fromPath('cat.jpg'));
   $message->edit('changed');                      // bot's own messages only
   $message->editCaption('a better caption');
   $message->editReplyMarkup($keyboard);
   $message->react('👍');                          // or react(null) to clear
   $message->pin();
   $message->unpin();
   $message->forward($otherChatId);
   $message->copy($otherChatId);                   // no link back to the original
   $message->delete();

Each takes an ``$options`` array for any other field of the underlying method, and what you pass wins
over what the part filled in:

.. code-block:: php

   $message->reply('<b>on it</b>', ['parse_mode' => 'HTML']);

**Chat**

.. code-block:: php

   $chat->sendMessage('hello');
   $chat->sendPhoto(InputFile::fromPath('cat.jpg'));
   $chat->sendAction('typing');
   $chat->fetch();                    // the full ChatFullInfo record
   $chat->getMember($userId);
   $chat->countMembers();
   $chat->ban($userId, ['until_date' => time() + 3600]);
   $chat->unban($userId);
   $chat->leave();

**User**

.. code-block:: php

   $user->getFullName();     // 'Ada Lovelace'
   $user->getHandle();       // '@ada', or the full name when they have no username
   $user->mention();         // an HTML link that works even without a username
   $user->mention('Markdown');
   $user->sendMessage('hi'); // only works if they started the bot first
   $user->getProfilePhotos();

**CallbackQuery**

.. code-block:: php

   $query->answer();                        // always answer - the button spins until you do
   $query->answer('Done', showAlert: true);
   $query->answerWithUrl('https://t.me/...');
   $query->editMessage('Deployed.');        // edits whichever message the button is under

**File**

.. code-block:: php

   $file->getUrl();              // includes the bot token - do not log it
   $file->download();            // promise of the bytes
   $file->save('/tmp/photo.jpg');

**Others**

``InlineQuery::answer()``, ``ChatJoinRequest::approve()`` and ``decline()``,
``PreCheckoutQuery::answer()``, ``ShippingQuery::answer()``.

Building a part yourself
========================

When you need one - to pass a structured object to a method, say - the factory builds it:

.. code-block:: php

   use Telegram\Parts\Message;

   $message = $telegram->getFactory()->part(Message::class, $rawArray);

Though for arguments you can equally pass a plain array: every field the API types as an object
accepts an array, a part, or anything else that is ``JsonSerializable``.
