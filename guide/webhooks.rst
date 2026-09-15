========
Webhooks
========

Polling asks Telegram for updates; a webhook has Telegram post them to you. Either is a complete way
to run a bot, and the choice is mostly about where the bot lives:

.. list-table::
   :header-rows: 1

   * - Long polling
     - Webhook
   * - Needs no public address - works from a laptop, behind NAT.
     - Needs a public HTTPS endpoint.
   * - One process holds the token.
     - Scales to several processes behind a load balancer.
   * - Updates arrive within the poll round.
     - Updates arrive as they happen.
   * - Costs a held-open connection.
     - Costs a running web server.

Start with polling. Move to a webhook when you have somewhere to host one.

Listening
=========

Give the client a ``webhook`` option and it listens instead of polling:

.. code-block:: php

   $telegram = new Telegram([
       'token' => $token,
       'webhook' => [
           'listen' => '0.0.0.0:8080',
           'path' => '/hook',
           'secret_token' => $secret,
       ],
   ]);

   $telegram->run();

Updates then reach your handlers exactly as they would under polling - see :doc:`events`. Nothing else
about your bot changes.

.. list-table::
   :header-rows: 1

   * - Key
     - Default
     - Description
   * - ``listen``
     - ``0.0.0.0:8080``
     - The address to bind. Any ``React\Socket\SocketServer`` address works.
   * - ``path``
     - ``/``
     - The path deliveries are accepted on. Anything else answers ``404``.
   * - ``secret_token``
     - -
     - Checked against the ``X-Telegram-Bot-Api-Secret-Token`` header.
   * - ``socket_context``
     - ``[]``
     - Passed to the socket server, for TLS if you terminate it here.

Registering the endpoint
========================

Telegram needs to be told where to deliver, which is a call like any other. Doing it on ``ready``
means the listener is already up when Telegram starts posting:

.. code-block:: php

   $telegram->on(Event::READY, function (Telegram $telegram) use ($url, $secret) {
       $telegram->setWebhook($url, secret_token: $secret, allowed_updates: [Event::MESSAGE]);
   });

To go back to polling, remove it - Telegram refuses to serve ``getUpdates`` while a webhook is set:

.. code-block:: php

   $telegram->deleteWebhook(drop_pending_updates: true);

``getWebhookInfo`` tells you what Telegram currently thinks, including why deliveries are failing:

.. code-block:: php

   $telegram->getWebhookInfo()->then(function (WebhookInfo $info) {
       $info->url;                    // '' when none is set
       $info->pending_update_count;
       $info->last_error_message;     // why the last delivery failed
   });

TLS
===

Telegram only delivers to HTTPS, and the certificate must be valid or self-signed *and* uploaded with
``setWebhook``. In practice the listener sits behind a reverse proxy that terminates TLS:

.. code-block:: nginx

   location /hook {
       proxy_pass http://127.0.0.1:8080;
       proxy_set_header X-Telegram-Bot-Api-Secret-Token $http_x_telegram_bot_api_secret_token;
   }

Make sure the proxy forwards that header - it is the only thing separating a real delivery from
anyone who guesses the URL.

The secret token
================

Set one. Your endpoint is a public URL that accepts JSON claiming to be from Telegram, and the secret
header is what makes that claim checkable. Deliveries that fail the check are answered ``403`` and
never reach your handlers.

.. code-block:: php

   $secret = bin2hex(random_bytes(16));   // store it; pass the same value both places

What the listener answers
=========================

.. list-table::
   :header-rows: 1

   * - Situation
     - Response
   * - A valid delivery
     - ``200 {"ok":true}``, as soon as the update is queued
   * - Wrong or missing secret
     - ``403``
   * - Another path, or a ``GET``
     - ``404``
   * - A body that is not JSON
     - ``400``
   * - Your handler threw
     - ``200`` anyway

That last row is deliberate. Telegram redelivers anything that is not a ``2xx``, and redelivery will
not fix a bug in a handler - it will only replay it. The exception is logged and emitted as
``Event::ERROR`` instead.

Answer quickly. Telegram waits only a few seconds and retries on timeout, so do the work after
answering rather than before - which is what the promise-based API does by default.
