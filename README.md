# TelegramPHP

An async [ReactPHP](https://reactphp.org) framework for the [Telegram Bot API](https://core.telegram.org/bots/api),
built the way [DiscordPHP](https://github.com/discord-php/DiscordPHP) is built: a non-blocking HTTP
transport, an event-emitting client, hydrated "parts" for every API object, and repositories that
cache what the bot has seen.

The API surface is **generated from the Bot API specification**. `spec/openapi.json` — an OpenAPI 3.1
document built from [PaulSonOfLars/telegram-bot-api-spec](https://github.com/PaulSonOfLars/telegram-bot-api-spec),
which is scraped from the official documentation — is the single input to the code generator, and the
test suite reads the same document to prove that every method and every one of its fields is
reachable from PHP.

**Bot API 10.3** · 185 methods · 400 types.

## Requirements

- PHP 8.4 or newer
- ext-json, ext-mbstring

## Installation

```bash
composer require vzgcoders/telegramphp
```

### Windows and SSL

A Windows PHP build usually ships without a CA bundle, so TLS to `api.telegram.org` fails. Point the
socket connector at one:

```php
$telegram = new Telegram([
    'token' => $token,
    'socket_options' => ['tls' => ['cafile' => 'C:/php/cacert.pem']],
]);
```

## Getting started

```php
use Telegram\Events\Event;
use Telegram\Parts\Message;
use Telegram\Telegram;

$telegram = new Telegram(['token' => getenv('TELEGRAM_TOKEN')]);

$telegram->on(Event::MESSAGE, function (Message $message) use ($telegram) {
    if ($message->text === 'ping') {
        $message->reply('pong');
    }
});

$telegram->run();
```

`run()` identifies the bot with `getMe`, starts long polling, and runs the event loop. Pass `false`
to keep the loop under your own control when the bot shares it with other services.

## Calling the API

Every Bot API method is a real method on the client, named exactly as Telegram names it, taking
exactly the fields Telegram documents. Required fields are positional; everything else is a named
argument:

```php
$telegram->sendMessage($chatId, 'Deploying now', parse_mode: 'HTML', disable_notification: true);

$telegram->getChat('@durov')->then(function (ChatFullInfo $chat) {
    echo $chat->title, ' — ', $chat->description, PHP_EOL;
});
```

Calls resolve with the result already hydrated: a `Message` part, a `Collection` of `Update` parts, a
`bool`. They reject with a [typed exception](#errors) when Telegram says no.

A method this build has never heard of — a newer Bot API server, or a local one with an extension —
is still reachable:

```php
$telegram->request('someFutureMethod', ['chat_id' => $chatId], ['Message']);
```

## Updates

Each update is emitted twice: once as `Event::UPDATE` carrying the whole `Update`, and once under its
own type carrying just that payload. The type constants are generated from the `Update` object, so
they are exactly the 27 types this Bot API version defines, and the same strings go in
`allowed_updates`.

```php
use Telegram\Events\Event;
use Telegram\Parts\CallbackQuery;

$telegram->on(Event::CALLBACK_QUERY, function (CallbackQuery $query) {
    $query->answer('Working on it');
    $query->editMessage('Deployed.');
});

$telegram = new Telegram([
    'token' => $token,
    'allowed_updates' => [Event::MESSAGE, Event::CALLBACK_QUERY],
    'drop_pending_updates' => true,
]);
```

### Webhooks

Give the client a `webhook` option and it listens instead of polling. Telegram requires HTTPS on the
public endpoint, so in practice this sits behind a reverse proxy that terminates TLS; the
`secret_token` is what separates a real delivery from anyone else who finds the URL.

```php
$telegram = new Telegram([
    'token' => $token,
    'webhook' => ['listen' => '0.0.0.0:8080', 'path' => '/hook', 'secret_token' => $secret],
]);

$telegram->setWebhook('https://bot.example.com/hook', secret_token: $secret);
$telegram->run();
```

## Parts

Every Bot API object is a part: array and property access, nested objects hydrated into parts,
`Array of X` into a `Collection`, timestamps into `CarbonImmutable`, and JSON serialisation back to
exactly what Telegram sent.

```php
$message->chat->title;
$message['from']['username'];
$message->date->diffForHumans();
$message->entities->first()->type;
```

Parts also carry behaviour, so the ids come off the object rather than out of your variables:

```php
$message->reply('on it');
$message->react('👍');
$message->pin();
$message->forward($otherChatId);

$chat->sendMessage('hello');
$chat->ban($userId, ['until_date' => time() + 3600]);

$user->mention();          // <a href="tg://user?id=…">Ada Lovelace</a>
$file->save('/tmp/photo.jpg');
```

Union types (`ChatMember`, `InputMedia`, `ReactionType`, …) resolve to the right member on the way in,
so a `getChatMember` answer arrives as a `ChatMemberAdministrator`, not a bag of attributes. A member
Telegram adds after this build was generated falls back to the closest match rather than failing the
update.

## Keyboards and uploads

```php
use Telegram\Builders\InlineKeyboard;
use Telegram\Builders\InputFile;
use Telegram\Builders\ReplyKeyboard;

$telegram->sendMessage($chatId, 'Deploy?', reply_markup: InlineKeyboard::new()
    ->callback('Ship it', 'deploy:yes')
    ->callback('Hold', 'deploy:no')
    ->row()
    ->url('What changed', 'https://example.com/diff'));

$telegram->sendMessage($chatId, 'Where are you?', reply_markup: ReplyKeyboard::new()
    ->requestLocation('Send my location')
    ->resize()
    ->oneTime());
```

Pass an `InputFile` anywhere the API accepts `InputFile or String` and the request becomes a
`multipart/form-data` upload — including files nested inside an `InputMedia`, which are rewritten to
`attach://` references for you. A `file_id` or an HTTP URL needs none of that; pass the string.

```php
$telegram->sendPhoto($chatId, InputFile::fromPath('cat.jpg'), caption: 'mine');

$telegram->sendMediaGroup($chatId, [
    ['type' => 'photo', 'media' => InputFile::fromPath('one.jpg')],
    ['type' => 'photo', 'media' => InputFile::fromPath('two.jpg')],
]);
```

Downloads go the other way:

```php
$telegram->downloadFile($photo->file_id)->then(fn (string $bytes) => file_put_contents('photo.jpg', $bytes));
```

## Commands

`TelegramCommandClient` is a client that routes slash commands — the counterpart of DiscordPHP's
`DiscordCommandClient`. A callback that returns a string has it sent back as a reply, and the listed
commands are published with `setMyCommands` when the bot is ready, so they appear in the command menu.

```php
use Telegram\CommandClient\TelegramCommandClient;
use Telegram\Parts\Message;

$bot = new TelegramCommandClient([
    'token' => getenv('TELEGRAM_TOKEN'),
    'description' => 'A helpful bot',
]);

$bot->registerCommand('ping', fn () => 'pong', ['description' => 'Checks the bot is alive']);

$bot->registerCommand('echo', fn (Message $message, array $args) => implode(' ', $args), [
    'description' => 'Repeats what you say',
    'aliases' => ['say'],
]);

$bot->run();
```

`/command@yourbot` is accepted as well as `/command`, which is how commands are addressed in groups,
and a command aimed at another bot is ignored. `/help` is built in; pass `help_command => null` to
turn it off, or `prefix => '!'` to answer to something other than a slash.

## Caches

`$telegram->chats` and `$telegram->users` hold what updates have brought in. The Bot API has no list
endpoints, so these are caches, not queries — a chat can be refreshed with `getChat`, while a user can
only be looked up through a chat you share with them.

```php
$telegram->chats->get($chatId);
$telegram->chats->fetch($chatId);          // getChat, cached on the way back
$telegram->users->fetchMember($chatId, $userId);
```

## Errors

Failed calls reject with a subclass of `Telegram\Http\Exceptions\HttpException` chosen by the error
code, carrying what Telegram said:

```php
use Telegram\Http\Exceptions\ForbiddenException;
use Telegram\Http\Exceptions\HttpException;

$telegram->sendMessage($chatId, 'hello')->then(null, function (HttpException $e) {
    if ($e instanceof ForbiddenException) {
        // Blocked by the user, or kicked from the chat.
    }

    $e->getErrorCode();        // 403
    $e->getRetryAfter();       // seconds, on a 429
    $e->getMigrateToChatId();  // the supergroup a migrated group became
});
```

A `429` is held for exactly the `retry_after` Telegram asks for and then replayed; transient `5xx` and
transport failures back off and retry. Only what is still failing afterwards reaches you.

## Configuration

| Option | Default | What it does |
| --- | --- | --- |
| `token` | *required* | The token from @BotFather. |
| `loop` | shared loop | The ReactPHP event loop to run on. |
| `logger` | `NullLogger` | A PSR-3 logger for the client's debug output. |
| `base_url` | `https://api.telegram.org` | Point this at a [local Bot API server](https://core.telegram.org/bots/api#using-a-local-bot-api-server). |
| `socket_options` | `[]` | Passed to `React\Socket\Connector` (see [Windows and SSL](#windows-and-ssl)). |
| `poll_timeout` | `50` | Seconds `getUpdates` holds the connection open. |
| `poll_limit` | `100` | Updates per round. |
| `allowed_updates` | `null` | Update types to receive; `null` keeps Telegram's default. |
| `drop_pending_updates` | `false` | Skip the backlog queued while the bot was down. |
| `webhook` | — | `listen`, `path`, `secret_token`: listen instead of polling. |
| `http` / `driver` | — | Replace the transport or its driver outright. |

## Development

The library is generated from the spec, so a new Bot API version is a regeneration rather than a
rewrite:

```bash
composer spec:build     # fetch api.json, build openapi.json, regenerate the library
composer test           # 4,500+ tests, including full spec coverage
composer cs             # php-cs-fixer
```

`composer spec:build` runs three steps, each usable on its own — `spec:fetch`, `spec:openapi`,
`spec:generate`. Regenerating overwrites `src/Telegram/Parts/*`, `src/Telegram/Api/*`,
`Http/Endpoint.php` and `Events/Event.php` wholesale, so hand-written behaviour lives in
`src/Telegram/Parts/Concerns/<Type>Behaviour.php` — a trait the generator mixes into the matching part
when the file exists.

The suite is mostly generated too: every method is checked for a PHP method with the documented
parameters and types, then called with every field the spec lists to prove that each one reaches the
request, and every type is hydrated from a synthetic payload and serialised back. If Telegram adds a
method or a field and nobody regenerates, the tests say so.

## License

MIT. See [LICENSE](LICENSE).
