=======================
Chats and users
=======================

``$telegram->chats`` and ``$telegram->users`` are repositories - the same accessors DiscordPHP has,
with an important difference behind them.

DiscordPHP repositories are backed by list endpoints: a guild can be asked for its members. The Bot
API has no such thing. A bot learns about a chat or a user by being *told* about them in an update,
and can look one up only if it already holds an identifier. So these are caches that updates fill in,
not queries.

.. code-block:: php

   $telegram->chats->get($chatId);        // whatever an update last told us, or null
   $telegram->chats->has($chatId);
   $telegram->chats->all();               // a Collection of every chat seen
   count($telegram->chats);
   $telegram->chats->clear();

   foreach ($telegram->chats as $chat) {
       // ...
   }

Ids arrive as integers but are often written as strings - out of a config file, off a command
argument - so lookups accept both. A ``@channelusername`` is left as it is, because it is not an id.

Filling the cache
=================

Every update that mentions a chat or a user puts it in, so the caches populate themselves as the bot
runs. A part already held is updated in place rather than replaced, so references you kept stay
current.

Fetching
========

A chat can be refreshed from Telegram, which answers with the much richer ``ChatFullInfo``:

.. code-block:: php

   $telegram->chats->fetch($chatId)->then(function (ChatFullInfo $chat) {
       $chat->description;
       $chat->permissions;
       $chat->pinned_message;
   });

   $telegram->chats->fetchOrGet($chatId);   // the cached one if there is one, else fetch
   $telegram->chats->countMembers($chatId);

The stub an update brought in is upgraded in place by a fetch: the cache holds the full record
afterwards, and anything only the stub knew is carried over rather than dropped.

Users
=====

There is no "get user" call in the Bot API, so ``$telegram->users->fetch()`` throws to say so rather
than pretending. What you can do is ask about a user *in a chat the bot shares with them*, which
caches the user on the way back:

.. code-block:: php

   $telegram->users->get($userId);                      // from what updates brought in
   $telegram->users->fetchMember($chatId, $userId)      // getChatMember
       ->then(fn (ChatMember $member) => $member->status);

Persistence
===========

The caches live in memory and start empty on every run. If your bot needs to know about a chat before
anyone has spoken to it - to post a scheduled message, say - store the id yourself when you first see
it, and remember that a group upgraded to a supergroup changes id (see :doc:`errors`).
