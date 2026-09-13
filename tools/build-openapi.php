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
 * Converts `spec/api.json` (the scraped Bot API description) into `spec/openapi.json`,
 * a self-contained OpenAPI 3.1 document.
 *
 * Every Bot API method becomes a `POST /{methodName}` operation whose request body is
 * the method's field list, and every Bot API type becomes a component schema. The
 * original Telegram type tokens survive as `x-telegram-types`, which is what
 * `tools/generate.php` reads to emit exact PHP types — so the OpenAPI document, not
 * the scrape, is the single input to code generation.
 */

$root = dirname(__DIR__);
$spec = json_decode(file_get_contents($root . '/spec/api.json'), true, 512, JSON_THROW_ON_ERROR);

$types = $spec['types'];
$methods = $spec['methods'];

/** Bot API version string, e.g. "Bot API 10.3" -> "10.3". */
$version = preg_replace('/[^0-9.]/', '', (string) $spec['version']);

/**
 * Turns a Telegram type token ("Integer", "Array of Message", "InputFile") into a
 * JSON Schema fragment.
 */
$schemaFor = static function (string $token) use (&$schemaFor, $types): array {
    if (str_starts_with($token, 'Array of ')) {
        return ['type' => 'array', 'items' => $schemaFor(substr($token, strlen('Array of ')))];
    }

    return match ($token) {
        'Integer' => ['type' => 'integer'],
        'String' => ['type' => 'string'],
        'Boolean' => ['type' => 'boolean'],
        'Float', 'Float number' => ['type' => 'number', 'format' => 'float'],
        'True' => ['type' => 'boolean', 'const' => true],
        'InputFile' => ['type' => 'string', 'format' => 'binary'],
        default => isset($types[$token])
            ? ['$ref' => '#/components/schemas/' . $token]
            : ['description' => 'Unmapped Telegram type: ' . $token],
    };
};

/**
 * Combines the one-or-more type tokens a field accepts into a single schema, keeping
 * the raw tokens around under `x-telegram-types`.
 *
 * @param list<string> $tokens
 */
$schemaForTokens = static function (array $tokens) use ($schemaFor): array {
    $schema = count($tokens) === 1
        ? $schemaFor($tokens[0])
        : ['anyOf' => array_values(array_map($schemaFor, $tokens))];

    $schema['x-telegram-types'] = array_values($tokens);

    return $schema;
};

/** Joins a spec description (a list of paragraphs) into one string. */
$describe = static fn (array $lines): string => implode("\n", $lines);

/**
 * Finds the field and per-subtype literal that discriminates a union parent, e.g.
 * ChatMember -> ('status', ['creator' => 'ChatMemberOwner', ...]).
 *
 * Returns null when the subtypes share no such field or the literals collide
 * (InlineQueryResult reuses `type` values between cached and uncached results).
 *
 * @param list<string> $subtypes
 *
 * @return array{0: string, 1: array<string, string>}|null
 */
$discriminatorFor = static function (array $subtypes) use ($types): ?array {
    $candidates = [];

    foreach ($subtypes as $subtype) {
        foreach ($types[$subtype]['fields'] ?? [] as $field) {
            if ($field['types'] !== ['String']) {
                continue;
            }
            if (preg_match('/(?:always|must be)\s+[\x{201C}"\x27]?([a-z_0-9]+)/iu', $field['description'], $m) === 1) {
                $candidates[$field['name']][$subtype] = $m[1];
            }
        }
    }

    foreach ($candidates as $name => $map) {
        if (count($map) !== count($subtypes)) {
            continue;
        }
        if (count(array_unique($map)) !== count($map)) {
            continue; // Ambiguous mapping — cannot address a subtype by its literal.
        }

        return [$name, array_flip($map)];
    }

    return null;
};

// -- Component schemas: one per Bot API type ---------------------------------

$schemas = [];

foreach ($types as $name => $type) {
    $schema = [
        'title' => $name,
        'description' => $describe($type['description'] ?? []),
        'externalDocs' => ['url' => $type['href']],
    ];

    if (! empty($type['subtypes'])) {
        $schema['oneOf'] = array_values(array_map($schemaFor, $type['subtypes']));
        $schema['x-telegram-subtypes'] = array_values($type['subtypes']);

        $objectSubtypes = array_values(array_filter($type['subtypes'], static fn ($subtype) => isset($types[$subtype])));

        if (count($objectSubtypes) === count($type['subtypes'])
            && ($discriminator = $discriminatorFor($objectSubtypes)) !== null) {
            [$propertyName, $mapping] = $discriminator;
            $schema['discriminator'] = [
                'propertyName' => $propertyName,
                'mapping' => array_map(static fn (string $subtype): string => '#/components/schemas/' . $subtype, $mapping),
            ];
        }

        $schemas[$name] = $schema;

        continue;
    }

    $schema['type'] = 'object';
    $schema['properties'] = [];
    $required = [];

    foreach ($type['fields'] ?? [] as $field) {
        $property = $schemaForTokens($field['types']);
        $property['description'] = $field['description'];
        $schema['properties'][$field['name']] = $property;

        if ($field['required']) {
            $required[] = $field['name'];
        }
    }

    if ($required !== []) {
        $schema['required'] = $required;
    }

    if (isset($type['subtype_of'])) {
        $schema['x-telegram-subtype-of'] = array_values($type['subtype_of']);
    }

    $schemas[$name] = $schema;
}

$components = [
    'schemas' => $schemas,
    'responses' => [
        'Error' => [
            'description' => 'The Bot API error envelope.',
            'content' => [
                'application/json' => [
                    'schema' => [
                        'type' => 'object',
                        'required' => ['ok', 'error_code', 'description'],
                        'properties' => [
                            'ok' => ['type' => 'boolean', 'const' => false],
                            'error_code' => ['type' => 'integer'],
                            'description' => ['type' => 'string'],
                            'parameters' => ['$ref' => '#/components/schemas/ResponseParameters'],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'securitySchemes' => [
        'botToken' => [
            'type' => 'apiKey',
            'in' => 'path',
            'name' => 'token',
            'description' => 'The token issued by @BotFather, carried in the request path as `/bot<token>/<method>`.',
        ],
    ],
];

// -- Paths: one POST operation per Bot API method -----------------------------

/**
 * True when any field of the method accepts an uploaded file.
 *
 * @param list<array<string, mixed>> $fields
 */
$usesInputFile = static function (array $fields): bool {
    foreach ($fields as $field) {
        foreach ($field['types'] as $token) {
            if (str_contains($token, 'InputFile')) {
                return true;
            }
        }
    }

    return false;
};

$paths = [];
$methodNames = array_keys($methods);
sort($methodNames);

foreach ($methodNames as $name) {
    $method = $methods[$name];
    $fields = $method['fields'] ?? [];

    $properties = [];
    $required = [];

    foreach ($fields as $field) {
        $property = $schemaForTokens($field['types']);
        $property['description'] = $field['description'];
        $properties[$field['name']] = $property;

        if ($field['required']) {
            $required[] = $field['name'];
        }
    }

    $bodySchema = ['type' => 'object', 'properties' => $properties];
    if ($required !== []) {
        $bodySchema['required'] = $required;
    }

    $returns = $method['returns'];
    $resultSchema = count($returns) === 1
        ? $schemaFor($returns[0])
        : ['anyOf' => array_values(array_map($schemaFor, $returns))];

    $content = ['application/json' => ['schema' => $bodySchema]];
    if ($usesInputFile($fields)) {
        $content['multipart/form-data'] = ['schema' => $bodySchema];
    }

    $description = $describe($method['description'] ?? []);
    $summary = strtok($description, "\n");

    $operation = [
        'operationId' => $name,
        'summary' => $summary === false ? $name : $summary,
        'description' => $description,
        'externalDocs' => ['url' => $method['href']],
        'x-telegram-returns' => array_values($returns),
        'responses' => [
            '200' => [
                'description' => 'Successful call; `result` carries ' . implode(' or ', $returns) . '.',
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'required' => ['ok', 'result'],
                            'properties' => [
                                'ok' => ['type' => 'boolean', 'const' => true],
                                'result' => $resultSchema,
                                'description' => ['type' => 'string'],
                            ],
                        ],
                    ],
                ],
            ],
            'default' => ['$ref' => '#/components/responses/Error'],
        ],
    ];

    if ($properties !== []) {
        $operation['requestBody'] = [
            'required' => $required !== [],
            'content' => $content,
        ];
    }

    $paths['/' . $name] = ['post' => $operation];
}

$document = [
    'openapi' => '3.1.0',
    'info' => [
        'title' => 'Telegram Bot API',
        'version' => $version,
        'summary' => $spec['version'] . ' (' . ($spec['release_date'] ?? '') . ')',
        'description' => "The HTTP interface for Telegram bots.\n\n"
            . "This document is generated by TelegramPHP from the machine-readable spec at\n"
            . "https://github.com/PaulSonOfLars/telegram-bot-api-spec, which is scraped from\n"
            . 'https://core.telegram.org/bots/api. Do not edit it by hand - run `composer spec:build`.',
        'termsOfService' => 'https://telegram.org/tos',
        'license' => ['name' => 'MIT', 'identifier' => 'MIT'],
    ],
    'externalDocs' => ['description' => 'Telegram Bot API reference', 'url' => 'https://core.telegram.org/bots/api'],
    'servers' => [[
        'url' => 'https://api.telegram.org/bot{token}',
        'description' => 'Telegram Bot API server. Self-hosted servers expose the same paths.',
        'variables' => ['token' => ['default' => 'TOKEN', 'description' => 'The bot token issued by @BotFather.']],
    ]],
    'security' => [['botToken' => []]],
    'x-bot-api-version' => $spec['version'],
    'x-bot-api-release-date' => $spec['release_date'] ?? null,
    'paths' => $paths,
    'components' => $components,
];

file_put_contents(
    $root . '/spec/openapi.json',
    json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n",
);

printf(
    "Wrote %s/spec/openapi.json - OpenAPI 3.1, %d operations, %d schemas (%s).\n",
    $root,
    count($paths),
    count($schemas),
    $spec['version'],
);
