# Changelog

All notable changes to this project are documented here.

## [Unreleased]

### Added

- Documentation: a twelve-page guide under `guide/` (getting started, calling the
  API, updates and events, parts, keyboards and files, commands, webhooks, error
  handling, the caches, the generated code, and an FAQ) alongside the
  phpDocumentor API reference, both built by `composer docs` and published to
  GitHub Pages by `.github/workflows/docs.yml` on a release, a manual dispatch, or
  a push whose commit message contains "build docs". The builder is
  `discord-php/phpdoc-tool`, the same patched phpDocumentor DiscordPHP and
  TwitchPHP document themselves with.
- The guide's table of update types is generated from the spec with everything
  else, so it cannot drift from the constants it documents.

- First release of TelegramPHP: an async ReactPHP client for the Telegram Bot API,
  modelled on DiscordPHP.
- `Telegram\Telegram` — the client. Owns the transport, the part factory, the
  chat and user caches, and the update source; emits `ready`, `update`, `error`,
  and one event per update type. Every Bot API method is a real method on it,
  named as Telegram names it and taking exactly the fields Telegram documents,
  with the required ones positional and the rest named arguments.
- `spec/api.json` and `spec/openapi.json` — the Bot API description (Bot API
  10.3, scraped by [PaulSonOfLars/telegram-bot-api-spec](https://github.com/PaulSonOfLars/telegram-bot-api-spec))
  and the OpenAPI 3.1 document built from it. The OpenAPI document is the single
  input to code generation and to the coverage tests, so the library, its
  documentation, and its tests all describe the same API.
- `tools/fetch-spec.php`, `tools/build-openapi.php`, `tools/generate.php`, wired
  up as `composer spec:fetch`, `spec:openapi`, `spec:generate`, and `spec:build`.
  Generation emits 400 parts, 185 methods across 12 topic traits, the `Endpoint`
  constants, and the `Event` constants.
- `Telegram\Http\Http` — non-blocking transport with a bounded request queue. It
  unwraps the Bot API envelope, maps errors to typed exceptions, holds a `429`
  for exactly the `retry_after` Telegram asks for before replaying the request,
  and retries transient `5xx` and transport failures. `base_url` points it at a
  local Bot API server.
- `Telegram\Parts\Part` and 400 generated parts — property and array access,
  nested objects hydrated into parts, `Array of X` into a `Collection`,
  timestamps read back as `CarbonImmutable`, and JSON serialisation back to what
  Telegram sent. Union types resolve to the right member on the way in, falling
  back to the closest match for a member added since the build was generated.
- `Telegram\Parts\Concerns\*Behaviour` — hand-written behaviour the generator
  mixes into parts: replying to, editing, reacting to, pinning, forwarding and
  copying a message; sending to and moderating a chat; naming and mentioning a
  user; answering a callback, inline, shipping, or pre-checkout query; approving
  a join request; downloading a file.
- `Telegram\Polling\Poller` and `Telegram\Webhook\Server` — the two update
  sources. Polling advances its offset past every update it has handled and backs
  off when a round fails; the webhook listener checks the `secret_token`, answers
  `200` as soon as the update is queued, and never lets a handler's exception turn
  into a redelivery.
- `Telegram\CommandClient\TelegramCommandClient` — slash-command routing with
  aliases, `/command@botname` addressing, a built-in `/help`, and automatic
  `setMyCommands` publication once the bot is ready.
- `Telegram\Builders\InlineKeyboard`, `ReplyKeyboard`, and `InputFile` — keyboard
  markup, and uploads that switch a request to `multipart/form-data`, rewriting
  files nested inside an `InputMedia` to `attach://` references.
- `Telegram\Repository\ChatRepository` and `UserRepository` — caches filled by
  incoming updates, with `getChat` and `getChatMember` behind them. A stub chat is
  upgraded in place when its full record arrives.
- A test suite of 4,500+ tests, most of them generated from the spec: every
  method has a PHP method with the documented parameters, types, and optionality;
  every method is called with every documented field to prove each one reaches the
  request, and with only its required fields to prove nothing else is sent; every
  type hydrates and serialises; the OpenAPI document is checked against the
  upstream scrape it came from.
