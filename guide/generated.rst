=========================
Generated from the spec
=========================

Most of this library is not written by hand. ``src/Telegram/Parts`` and ``src/Telegram/Api`` -
400 parts and 185 methods - are generated from a machine-readable description of the Bot API, along
with the endpoint constants and the update-type constants.

That is worth knowing for two reasons: it is why the coverage is exact, and it changes where you make
a change.

The pipeline
============

.. code-block:: text

   core.telegram.org/bots/api            the documentation
     |  scraped by PaulSonOfLars/telegram-bot-api-spec
     v
   spec/api.json                         185 methods, 400 types
     |  tools/build-openapi.php
     v
   spec/openapi.json                     OpenAPI 3.1, the single source for everything below
     |  tools/generate.php
     v
   src/Telegram/Parts/*.php              one part per type
   src/Telegram/Api/*Api.php             one method per Bot API method
   src/Telegram/Http/Endpoint.php        a constant per method name
   src/Telegram/Events/Event.php         a constant per update type
   guide/_generated/update-types.rst     the table in this guide

``spec/openapi.json`` is a normal OpenAPI 3.1 document - one ``POST`` operation per Bot API method,
one component schema per type, ``oneOf`` with a discriminator for the union types - so it is useful
outside this library too, for a mock server or a client in another language. The original Telegram
type tokens are preserved on every field as ``x-telegram-types``, which is what lets the generator
emit exact PHP types rather than guessing from JSON Schema.

Regenerating
============

When Telegram ships a new Bot API version:

.. code-block:: shell

   $ composer spec:build

That fetches the current ``api.json``, rebuilds ``openapi.json``, and regenerates the library. The
three steps are also available on their own as ``spec:fetch``, ``spec:openapi`` and ``spec:generate``.

Then run the tests. Most of them are generated from the same document, so they will tell you exactly
what changed and whether anything hand-written no longer lines up:

.. code-block:: shell

   $ composer test

Where to put your changes
=========================

Regenerating overwrites the generated files wholesale - a part you edited is a part you lose. Hand-
written behaviour lives in a trait instead, which the generator mixes into the matching part when the
file exists:

.. code-block:: php

   // src/Telegram/Parts/Concerns/PollBehaviour.php

   namespace Telegram\Parts\Concerns;

   use React\Promise\PromiseInterface;

   trait PollBehaviour
   {
       /** @return PromiseInterface<\Telegram\Parts\Poll> */
       public function stop(): PromiseInterface
       {
           return $this->telegram->request('stopPoll', [
               'chat_id' => $this->chat_id,
               'message_id' => $this->message_id,
           ], ['Poll']);
       }
   }

Name the file ``<Type>Behaviour.php`` and run ``composer spec:generate``. ``Telegram\Parts\Poll`` will
now ``use Concerns\PollBehaviour``, and a test checks that every behaviour trait belongs to a part
that actually uses it.

A trait method also overrides an inherited one, which is how ``MaybeInaccessibleMessage`` replaces the
generated union resolver with Telegram's documented rule.

.. warning::

   Before adding a method to the ``Telegram`` client itself, check the name is not a Bot API method. A
   method declared on the class silently wins over the one a trait brings in, which would leave that
   API method unreachable. This is why stopping the loop is ``shutdown()`` rather than ``close()`` -
   ``close`` is a Bot API method. A test guards against it happening again.

What the tests check
====================

The suite reads ``spec/openapi.json`` rather than the generator's output, so it measures the library
against the specification rather than against itself:

- every documented method exists in PHP, returns a promise, and has an endpoint constant;
- its parameters are named exactly as the spec names them, in required-first order, typed to accept
  every documented form, and optional exactly where the spec says so;
- every method, called with every documented field, puts all of them on the wire unaltered - and
  called with only its required fields, sends nothing else;
- every documented type has a part that accepts all its fields, hydrates, and serialises back;
- the tagged unions resolve to the right member.

If Telegram adds a method or a field and nobody regenerates, the tests say so.
