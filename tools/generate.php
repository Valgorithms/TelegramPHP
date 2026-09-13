<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

/**
 * Generates the library surface from `spec/openapi.json`:
 *
 *  - `src/Telegram/Parts/*.php`      one part per Bot API type, unions included
 *  - `src/Telegram/Api/*Api.php`     one trait per method group, one method per Bot API method
 *  - `src/Telegram/Api/Methods.php`  the trait `Telegram` uses to pull all groups in
 *  - `src/Telegram/Http/Endpoint.php`  a constant per method name
 *  - `src/Telegram/Events/Event.php`   a constant per update type
 *
 * Everything it writes is overwritten wholesale on the next run, so hand-written
 * behaviour goes in `src/Telegram/Parts/Concerns/<Type>Behaviour.php` instead -
 * a trait the generator mixes into the matching part when the file exists.
 *
 * Usage: composer spec:build (or php tools/generate.php)
 */

$root = dirname(__DIR__);
$document = json_decode(file_get_contents($root . '/spec/openapi.json'), true, 512, JSON_THROW_ON_ERROR);

$schemas = $document['components']['schemas'];
$paths = $document['paths'];
$apiVersion = (string) $document['x-bot-api-version'];

const HEADER = <<<'PHP'
    <?php

    /*
     * This file is a part of the TelegramPHP project.
     *
     * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
     *
     * This file is subject to the MIT license that is bundled
     * with this source code in the LICENSE file.
     */

    PHP;

/** Marks a file as generated, so nobody edits it by hand. */
function generatedNote(string $apiVersion): string
{
    return "This file is generated from spec/openapi.json ({$apiVersion}) by tools/generate.php.\n"
        . 'Do not edit it by hand - run `composer spec:build` instead.';
}

/** Writes a generated file with LF endings, whatever the host platform uses. */
function writeGenerated(string $path, string $contents): void
{
    file_put_contents($path, str_replace("\r\n", "\n", $contents));
}

/** SCREAMING_SNAKE_CASE for a camelCase Bot API method name. */
function constantName(string $method): string
{
    return strtoupper(preg_replace('/(?<!^)[A-Z]/', '_$0', $method));
}

/** Escapes text for inclusion in a docblock. */
function docSafe(string $text): string
{
    return str_replace('*/', '*\/', $text);
}

/**
 * Wraps a description into docblock lines.
 *
 * @return list<string>
 */
function wrapDoc(string $text, int $width = 96, string $continuation = ''): array
{
    $lines = [];

    foreach (explode("\n", docSafe(trim($text))) as $paragraph) {
        if (trim($paragraph) === '') {
            $lines[] = '';

            continue;
        }

        $wrapped = explode("\n", wordwrap(trim($paragraph), $width, "\n", false));
        foreach ($wrapped as $index => $line) {
            $lines[] = ($index === 0 ? '' : $continuation) . $line;
        }
    }

    return $lines;
}

/** Renders docblock body lines with the leading ` * `. */
function docBlock(array $lines, string $indent = ''): string
{
    $out = $indent . "/**\n";

    foreach ($lines as $line) {
        $out .= rtrim($indent . ' * ' . $line) . "\n";
    }

    return $out . $indent . " */\n";
}

/**
 * The Telegram type tokens a schema node accepts, as the builder recorded them.
 *
 * @return list<string>
 */
function tokensOf(array $schema): array
{
    if (isset($schema['x-telegram-types'])) {
        return $schema['x-telegram-types'];
    }

    if (isset($schema['$ref'])) {
        return [basename($schema['$ref'])];
    }

    return match ($schema['type'] ?? null) {
        'integer' => ['Integer'],
        'number' => ['Float'],
        'boolean' => ['Boolean'],
        'string' => ['String'],
        default => ['String'],
    };
}

/** True for the four Telegram primitives (plus the upload pseudo-type). */
function isPrimitive(string $token): bool
{
    return in_array($token, ['Integer', 'String', 'Boolean', 'Float', 'True', 'InputFile'], true);
}

/** The innermost token of an `Array of Array of X`. */
function innerToken(string $token): string
{
    while (str_starts_with($token, 'Array of ')) {
        $token = substr($token, strlen('Array of '));
    }

    return $token;
}

/**
 * The native PHP type pieces one Telegram token contributes to a parameter type.
 *
 * Object types accept either a part (or builder - everything the library hands
 * back is `JsonSerializable`) or the plain array form, which is how most callers
 * write them inline.
 *
 * @return list<string>
 */
function nativeTypesFor(string $token): array
{
    if (str_starts_with($token, 'Array of ')) {
        return ['array'];
    }

    return match ($token) {
        'Integer' => ['int'],
        'String' => ['string'],
        'Boolean', 'True' => ['bool'],
        'Float' => ['float'],
        'InputFile' => ['\\Telegram\\Builders\\InputFile'],
        default => ['array', '\\JsonSerializable'],
    };
}

/**
 * The PHPDoc type for a token - precise where the native type cannot be.
 */
function docTypeFor(string $token): string
{
    if (str_starts_with($token, 'Array of ')) {
        return 'list<' . docTypeFor(substr($token, strlen('Array of '))) . '>';
    }

    return match ($token) {
        'Integer' => 'int',
        'String' => 'string',
        'Boolean', 'True' => 'bool',
        'Float' => 'float',
        'InputFile' => '\\Telegram\\Builders\\InputFile',
        default => '\\Telegram\\Parts\\' . $token . '|array',
    };
}

/**
 * The PHPDoc type a hydrated part attribute reads back as.
 */
function attributeDocType(string $token): string
{
    if (str_starts_with($token, 'Array of ')) {
        $inner = substr($token, strlen('Array of '));
        $innerType = attributeDocType($inner);

        return isPrimitive(innerToken($inner)) && ! str_starts_with($inner, 'Array of ')
            ? 'array<int, ' . $innerType . '>'
            : '\\Discord\\Helpers\\Collection<' . $innerType . '>';
    }

    return match ($token) {
        'Integer' => 'int',
        'String' => 'string',
        'Boolean', 'True' => 'bool',
        'Float' => 'float',
        'InputFile' => 'string',
        default => '\\Telegram\\Parts\\' . $token,
    };
}

/**
 * Builds the native parameter type for a field, given every token it accepts.
 *
 * @param list<string> $tokens
 */
function nativeTypeFor(array $tokens, bool $nullable): string
{
    $pieces = [];

    foreach ($tokens as $token) {
        foreach (nativeTypesFor($token) as $piece) {
            $pieces[$piece] = true;
        }
    }

    $pieces = array_keys($pieces);

    if ($nullable) {
        $pieces[] = 'null';
    }

    if (count($pieces) === 2 && in_array('null', $pieces, true)) {
        return '?' . current(array_diff($pieces, ['null']));
    }

    return implode('|', $pieces);
}

/** Timestamp attributes, which parts read back as CarbonImmutable. */
function isDateField(string $name, array $tokens): bool
{
    return $tokens === ['Integer']
        && (str_ends_with($name, '_date') || $name === 'date' || str_ends_with($name, '_timestamp'));
}

/** Renders a PHP array literal for a flat list of strings. */
function listLiteral(array $values, string $indent): string
{
    if ($values === []) {
        return '[]';
    }

    $out = "[\n";
    foreach ($values as $value) {
        $out .= $indent . "    '" . $value . "',\n";
    }

    return $out . $indent . ']';
}

/** Renders a PHP array literal for a string => string map. */
function mapLiteral(array $map, string $indent, bool $rawValues = false): string
{
    if ($map === []) {
        return '[]';
    }

    $width = max(array_map(static fn ($key): int => strlen((string) $key), array_keys($map)));
    $out = "[\n";

    foreach ($map as $key => $value) {
        $rendered = $rawValues ? $value : "'" . $value . "'";
        $out .= $indent . '    ' . str_pad("'" . $key . "'", $width + 2) . ' => ' . $rendered . ",\n";
    }

    return $out . $indent . ']';
}

// ---------------------------------------------------------------------------
// Parts
// ---------------------------------------------------------------------------

$partsDir = $root . '/src/Telegram/Parts';
$concernsDir = $partsDir . '/Concerns';

/**
 * Clears out the previous run so a type or method dropped upstream does not
 * linger as a stale class. Only generated files are touched - `Part.php` and
 * everything under `Concerns/` is hand-written.
 */
foreach (glob($partsDir . '/*.php') as $file) {
    if (basename($file) !== 'Part.php') {
        unlink($file);
    }
}

foreach (glob($root . '/src/Telegram/Api/*.php') as $file) {
    unlink($file);
}

/** Union parents, so children can extend them. */
$parentOf = [];
foreach ($schemas as $name => $schema) {
    foreach ($schema['x-telegram-subtype-of'] ?? [] as $parent) {
        if (isset($schemas[$parent])) {
            $parentOf[$name] = $parent;

            break;
        }
    }
}

$writtenParts = [];

foreach ($schemas as $name => $schema) {
    $isUnion = isset($schema['x-telegram-subtypes']);
    $parent = $parentOf[$name] ?? null;
    $behaviour = is_file($concernsDir . '/' . $name . 'Behaviour.php') ? $name . 'Behaviour' : null;

    $doc = wrapDoc($schema['description'] ?? $name);
    $doc[] = '';

    $fillable = [];
    $casts = [];
    $dates = [];
    $properties = [];

    foreach ($schema['properties'] ?? [] as $field => $property) {
        $tokens = tokensOf($property);
        $fillable[] = $field;

        if (! isPrimitive(innerToken($tokens[0])) || count($tokens) > 1 || str_starts_with($tokens[0], 'Array of ')) {
            // Anything that is not a bare primitive goes through the factory, which
            // leaves scalars alone but builds parts and collections.
            $casts[$field] = $tokens[0];
        }

        if (isDateField($field, $tokens)) {
            $dates[] = $field;
        }

        $required = in_array($field, $schema['required'] ?? [], true);
        $docType = implode('|', array_map(attributeDocType(...), $tokens));
        if (in_array($field, $dates, true)) {
            $docType = '\\Carbon\\CarbonImmutable';
        }
        $properties[] = [
            'type' => $required ? $docType : $docType . '|null',
            'name' => $field,
            'description' => $property['description'] ?? '',
        ];
    }

    if ($properties !== []) {
        $width = max(array_map(static fn ($p): int => strlen($p['type']), $properties));
        foreach ($properties as $property) {
            $summary = strtok(str_replace("\n", ' ', $property['description']), "\n");
            $line = '@property ' . str_pad($property['type'], $width) . ' $' . $property['name'];
            $doc[] = rtrim($line . ' ' . docSafe((string) $summary));
        }
        $doc[] = '';
    }

    if ($isUnion) {
        $doc[] = 'One of: ' . implode(', ', $schema['x-telegram-subtypes']) . '.';
        $doc[] = '';
    }

    $doc[] = '@link ' . $schema['externalDocs']['url'];
    $doc[] = '';
    $doc[] = '@since ' . $apiVersion;

    $body = HEADER . "\n";
    $body .= "namespace Telegram\\Parts;\n\n";
    $body .= docBlock(array_merge(wrapDoc(rtrim(generatedNote($apiVersion))), [''], $doc));

    $extends = $parent ?? 'Part';
    $body .= ($isUnion ? 'abstract ' : '') . 'class ' . $name . ' extends ' . $extends . "\n{\n";

    if ($behaviour !== null) {
        $body .= '    use Concerns\\' . $behaviour . ";\n\n";
    }

    if ($isUnion) {
        $subtypes = array_values(array_filter($schema['x-telegram-subtypes'], static fn ($s): bool => isset($GLOBALS['schemas'][$s])));
        $discriminator = $schema['discriminator'] ?? null;

        $body .= "    /** The attribute whose value names the concrete subtype. */\n";
        $body .= '    public const DISCRIMINATOR = ' . ($discriminator === null ? 'null' : "'" . $discriminator['propertyName'] . "'") . ";\n\n";

        $map = [];
        if ($discriminator !== null) {
            foreach ($discriminator['mapping'] as $value => $ref) {
                $map[$value] = basename($ref) . '::class';
            }
            $literal = mapLiteral($map, '    ', true);
        } else {
            $literal = "[\n";
            foreach ($subtypes as $subtype) {
                $literal .= '        ' . $subtype . "::class,\n";
            }
            $literal .= '    ]';
        }

        $body .= "    /** @var array<string, class-string<Part>>|list<class-string<Part>> */\n";
        $body .= '    public const SUBTYPES = ' . $literal . ";\n";
    } else {
        if ($parent !== null) {
            $body .= "    /** @var array<string, class-string<Part>>|list<class-string<Part>> */\n";
            $body .= "    public const SUBTYPES = [];\n\n";
            $body .= "    /** The attribute whose value names the concrete subtype. */\n";
            $body .= "    public const DISCRIMINATOR = null;\n\n";
        }

        $body .= "    /** @var list<string> */\n";
        $body .= '    protected array $fillable = ' . listLiteral($fillable, '    ') . ";\n";

        if ($casts !== []) {
            $body .= "\n    /** @var array<string, string> */\n";
            $body .= '    protected array $casts = ' . mapLiteral($casts, '    ') . ";\n";
        }

        if ($dates !== []) {
            $body .= "\n    /** @var list<string> */\n";
            $body .= '    protected array $dates = ' . listLiteral($dates, '    ') . ";\n";
        }
    }

    $body .= "}\n";

    writeGenerated($partsDir . '/' . $name . '.php', $body);
    $writtenParts[] = $name;
}

// ---------------------------------------------------------------------------
// API method traits
// ---------------------------------------------------------------------------

/**
 * Which trait a Bot API method belongs to. Rules are tried in order, so the
 * narrower ones come first; anything unmatched lands in `MiscApi` and is
 * reported at the end of the run.
 *
 * @var list<array{0: string, 1: string}> Regular expression => group.
 */
$groupRules = [
    ['/^(getUpdates|setWebhook|deleteWebhook|getWebhookInfo)$/', 'Update'],
    ['/^setPassportDataErrors$/', 'Passport'],
    ['/^(sendGame|setGameScore|getGameHighScores)$/', 'Game'],
    ['/^(getFile|uploadStickerFile)$/', 'File'],
    ['/Sticker/', 'Sticker'],
    ['/[Gg]ift/', 'Gift'],
    ['/(Business|Story)/', 'Business'],
    ['/(Invoice|ShippingQuery|PreCheckoutQuery|StarTransactions|StarPayment|StarSubscription|StarBalance|refund)/', 'Payment'],
    ['/(InlineQuery|WebAppQuery|CallbackQuery|PreparedInlineMessage|PreparedKeyboardButton|WebApp|GuestQuery)/', 'Inline'],
    ['/^(getMe|logOut|close|.*MyCommands|.*MyName|.*MyDescription|.*MyShortDescription|.*MyDefaultAdministratorRights|.*MyProfilePhoto|.*ManagedBot.*)$/', 'Bot'],
    ['/ChatMenuButton$/', 'Bot'],
    ['/(Forum|ChatMember|ChatInviteLink|ChatSubscriptionInviteLink|JoinRequest|ChatAdministrators|ChatPermissions|ChatPhoto|ChatTitle|ChatDescription|ChatStickerSet|ChatSenderChat|leaveChat|^getChat|verify|Verification|UserChatBoosts|UserProfile|UserPersonalChatMessages|UserEmojiStatus|SuggestedPost)/', 'Chat'],
    ['/(Message|Poll|Checklist|ChatAction|Reaction|Photo|Audio|Video|Voice|Document|Animation|Contact|Location|Venue|Dice|MediaGroup|PaidMedia|LivePhoto|forward|copy)/', 'Message'],
    ['/Chat/', 'Chat'],
];

/** @var array<string, list<string>> */
$groups = [];

foreach (array_keys($paths) as $path) {
    $method = ltrim($path, '/');
    $group = 'Misc';

    foreach ($groupRules as [$pattern, $candidate]) {
        if (preg_match($pattern, $method) === 1) {
            $group = $candidate;

            break;
        }
    }

    $groups[$group][] = $method;
}

ksort($groups);

$groupDescriptions = [
    'Bot' => "The bot's own identity and settings - its name, descriptions, command list, default rights, profile photo, and the managed-bot endpoints.",
    'Business' => 'Telegram Business accounts a bot manages on a user\'s behalf, and the stories it posts for them.',
    'Chat' => 'Chats and the people in them: membership, administrators, permissions, invite links, forum topics, join requests, and chat appearance.',
    'File' => 'Locating and uploading files.',
    'Game' => 'HTML5 games and their high-score tables.',
    'Gift' => 'Gifts and Telegram Premium subscriptions a bot can send, upgrade, transfer, or convert back to Stars.',
    'Inline' => 'Inline mode, callback queries, and Mini App queries - everything the bot answers rather than initiates.',
    'Message' => 'Sending, editing, forwarding, reacting to, pinning, and deleting messages of every media type.',
    'Misc' => 'Methods that did not fit another group.',
    'Passport' => 'Telegram Passport error reporting.',
    'Payment' => 'Invoices, checkout, refunds, and the Telegram Stars balance.',
    'Sticker' => 'Sticker sets: creating them, editing their contents, and their thumbnails.',
    'Update' => 'Receiving updates, by long polling or by webhook.',
];

$apiDir = $root . '/src/Telegram/Api';
$generatedMethods = 0;

foreach ($groups as $group => $methods) {
    sort($methods);
    $trait = $group . 'Api';

    $body = HEADER . "\n";
    $body .= "namespace Telegram\\Api;\n\n";
    $body .= "use React\\Promise\\PromiseInterface;\n\n";

    $intro = array_merge(
        wrapDoc(rtrim(generatedNote($apiVersion))),
        [''],
        wrapDoc($groupDescriptions[$group] ?? 'Bot API methods.'),
        [
            '',
            'Mixed into {@see \\Telegram\\Telegram} through {@see Methods}. Every method is',
            'named exactly as the Bot API names it, takes exactly the fields the Bot API',
            'documents (use named arguments for the optional ones), and resolves with the',
            'hydrated result.',
            '',
            '@link https://core.telegram.org/bots/api',
            '',
            '@since ' . $apiVersion,
        ],
    );

    $body .= docBlock($intro);
    $body .= 'trait ' . $trait . "\n{\n";

    $rendered = [];

    foreach ($methods as $method) {
        $operation = $paths['/' . $method]['post'];
        $properties = $operation['requestBody']['content']['application/json']['schema']['properties'] ?? [];
        $required = $operation['requestBody']['content']['application/json']['schema']['required'] ?? [];
        $returns = $operation['x-telegram-returns'];

        // Required parameters first so positional calls stay possible.
        $ordered = [];
        foreach ($properties as $field => $property) {
            if (in_array($field, $required, true)) {
                $ordered[$field] = $property;
            }
        }
        foreach ($properties as $field => $property) {
            if (! in_array($field, $required, true)) {
                $ordered[$field] = $property;
            }
        }

        $doc = wrapDoc($operation['description']);
        $doc[] = '';

        $signature = [];

        foreach ($ordered as $field => $property) {
            $tokens = tokensOf($property);
            $isRequired = in_array($field, $required, true);
            $nativeType = nativeTypeFor($tokens, ! $isRequired);
            $docType = implode('|', array_map(docTypeFor(...), $tokens)) . ($isRequired ? '' : '|null');

            $signature[] = '        ' . $nativeType . ' $' . $field . ($isRequired ? '' : ' = null') . ',';

            $description = str_replace("\n", ' ', $property['description'] ?? '');
            if (! $isRequired && ! str_starts_with($description, 'Optional')) {
                $description = 'Optional. ' . $description;
            }

            $paramDoc = wrapDoc('@param ' . $docType . ' $' . $field . ' ' . $description, 100, '       ');
            foreach ($paramDoc as $line) {
                $doc[] = $line;
            }
        }

        if ($ordered !== []) {
            $doc[] = '';
        }

        $resultDoc = implode('|', array_map(attributeDocType(...), $returns));
        $doc[] = '@return PromiseInterface<' . $resultDoc . '>';
        $doc[] = '';
        $doc[] = '@link ' . $operation['externalDocs']['url'];

        $returnsLiteral = "['" . implode("', '", $returns) . "']";

        // PSR-12 puts the brace on its own line for a one-line signature, and on
        // the closing parenthesis for a wrapped one.
        $head = $signature === []
            ? '    public function ' . $method . "(): PromiseInterface\n    {\n"
            : '    public function ' . $method . "(\n" . implode("\n", $signature) . "\n    ): PromiseInterface {\n";

        $rendered[] = docBlock($doc, '    ')
            . $head
            . '        return $this->callApi(' . "'" . $method . "', "
            . ($signature === [] ? '[]' : 'get_defined_vars()') . ', ' . $returnsLiteral . ");\n    }\n";

        ++$generatedMethods;
    }

    $body .= implode("\n", $rendered);
    $body .= "}\n";

    writeGenerated($apiDir . '/' . $trait . '.php', $body);
}

// The aggregate trait the client uses.
$traitNames = array_map(static fn (string $group): string => $group . 'Api', array_keys($groups));

$body = HEADER . "\n";
$body .= "namespace Telegram\\Api;\n\n";
$body .= docBlock(array_merge(
    wrapDoc(rtrim(generatedNote($apiVersion))),
    [
        '',
        'Every Bot API method, gathered from the per-topic traits into the one trait',
        '{@see \\Telegram\\Telegram} uses. The client supplies {@see callApi()}, which',
        'drops unset arguments, encodes what is left, and hydrates the result.',
        '',
        '@link https://core.telegram.org/bots/api',
        '',
        '@since ' . $apiVersion,
    ],
));
$body .= "trait Methods\n{\n";
foreach ($traitNames as $trait) {
    $body .= '    use ' . $trait . ";\n";
}
$body .= "\n    /**\n"
    . "     * Dispatches one Bot API call.\n"
    . "     *\n"
    . '     * @param array<string, mixed> $' . "arguments The method's arguments, unset ones included.\n"
    . '     * @param list<string>         $' . "returns   Telegram type tokens the result hydrates as.\n"
    . "     *\n"
    . "     * @return PromiseInterface<mixed>\n"
    . "     */\n"
    . "    abstract protected function callApi(string \$method, array \$arguments, array \$returns): \\React\\Promise\\PromiseInterface;\n";
$body .= "}\n";

writeGenerated($apiDir . '/Methods.php', $body);

// ---------------------------------------------------------------------------
// Endpoint constants
// ---------------------------------------------------------------------------

$endpointBody = HEADER . "\n";
$endpointBody .= "namespace Telegram\\Http;\n\n";
$endpointBody .= docBlock(array_merge(
    wrapDoc(rtrim(generatedNote($apiVersion))),
    [
        '',
        'Every Bot API method name, as a constant.',
        '',
        'The Bot API is flat - a call is a `POST` to `/bot<token>/<method>` with a JSON',
        'body - so an endpoint is just the method name. Use these where a method name is',
        'passed around ({@see Http::execute()}) to keep typos out of the call site.',
        '',
        '@link https://core.telegram.org/bots/api#available-methods',
        '',
        '@since ' . $apiVersion,
    ],
));
$endpointBody .= "final class Endpoint\n{\n";

$constants = [];
foreach (array_keys($paths) as $path) {
    $method = ltrim($path, '/');
    $constants[constantName($method)] = $method;
}

$width = max(array_map(strlen(...), array_keys($constants)));
foreach ($constants as $constant => $method) {
    $endpointBody .= '    public const ' . str_pad($constant, $width) . " = '" . $method . "';\n";
}

$endpointBody .= "\n    /** @return list<string> Every Bot API method this build knows about. */\n";
$endpointBody .= "    public static function all(): array\n    {\n";
$endpointBody .= "        return array_values((new \\ReflectionClass(self::class))->getConstants());\n    }\n";
$endpointBody .= "}\n";

writeGenerated($root . '/src/Telegram/Http/Endpoint.php', $endpointBody);

// ---------------------------------------------------------------------------
// Update event constants
// ---------------------------------------------------------------------------

$updateFields = array_keys($schemas['Update']['properties']);
$updateTypes = array_values(array_filter($updateFields, static fn (string $field): bool => $field !== 'update_id'));

$eventBody = HEADER . "\n";
$eventBody .= "namespace Telegram\\Events;\n\n";
$eventBody .= docBlock(array_merge(
    wrapDoc(rtrim(generatedNote($apiVersion))),
    [
        '',
        'The update types a bot can receive, which are also the event names',
        '{@see \\Telegram\\Telegram} emits:',
        '',
        '```php',
        '$telegram->on(Event::MESSAGE, function (Message $message) {',
        '    $message->reply(\'hello\');',
        '});',
        '```',
        '',
        'The same strings go in the `allowed_updates` array of `getUpdates` and',
        '`setWebhook`; {@see all()} is the full list.',
        '',
        '@link https://core.telegram.org/bots/api#update',
        '',
        '@since ' . $apiVersion,
    ],
));
$eventBody .= "final class Event\n{\n";
$eventBody .= "    /** Emitted for every update, whatever its type, with the Update part. */\n";
$eventBody .= "    public const UPDATE = 'update';\n\n";
$eventBody .= "    /** Emitted once the bot has identified itself and updates are flowing. */\n";
$eventBody .= "    public const READY = 'ready';\n\n";
$eventBody .= "    /** Emitted with any error the client could not hand to a caller. */\n";
$eventBody .= "    public const ERROR = 'error';\n\n";

$eventConstants = [];
foreach ($updateTypes as $type) {
    $eventConstants[strtoupper($type)] = $type;
}

$width = max(array_map(strlen(...), array_keys($eventConstants)));
foreach ($eventConstants as $constant => $type) {
    $description = $schemas['Update']['properties'][$type]['description'] ?? '';
    $summary = trim(str_replace('Optional. ', '', str_replace("\n", ' ', $description)));
    $eventBody .= '    /** ' . docSafe($summary) . " */\n";
    $eventBody .= '    public const ' . str_pad($constant, $width) . " = '" . $type . "';\n\n";
}

$eventBody .= "    /** @var array<string, string> Update field => the part class it carries. */\n";
$eventBody .= "    public const PAYLOAD_TYPES = [\n";
foreach ($updateTypes as $type) {
    $tokens = tokensOf($schemas['Update']['properties'][$type]);
    $eventBody .= "        '" . $type . "' => '" . $tokens[0] . "',\n";
}
$eventBody .= "    ];\n\n";
$eventBody .= "    /** @return list<string> Every update type, for `allowed_updates`. */\n";
$eventBody .= "    public static function all(): array\n    {\n";
$eventBody .= "        return array_keys(self::PAYLOAD_TYPES);\n    }\n";
$eventBody .= "}\n";

writeGenerated($root . '/src/Telegram/Events/Event.php', $eventBody);

// ---------------------------------------------------------------------------

printf(
    "Generated %d parts, %d methods across %d traits, %d endpoints, %d update types.\n",
    count($writtenParts),
    $generatedMethods,
    count($groups),
    count($constants),
    count($updateTypes),
);

foreach ($groups as $group => $methods) {
    printf("  %-10s %3d methods\n", $group, count($methods));
}

if (isset($groups['Misc'])) {
    fwrite(STDERR, 'Ungrouped methods landed in MiscApi: ' . implode(', ', $groups['Misc']) . "\n");
}
