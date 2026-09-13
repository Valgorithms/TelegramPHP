<?php

/*
 * This file is a part of the TelegramPHP project.
 *
 * Copyright (c) 2026-present Valithor Obsidion <valithor@valgorithms.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE file.
 */

namespace Telegram\Api;

use React\Promise\PromiseInterface;

/**
 * This file is generated from spec/openapi.json (Bot API 10.3) by tools/generate.php.
 * Do not edit it by hand - run `composer spec:build` instead.
 *
 * Telegram Passport error reporting.
 *
 * Mixed into {@see \Telegram\Telegram} through {@see Methods}. Every method is
 * named exactly as the Bot API names it, takes exactly the fields the Bot API
 * documents (use named arguments for the optional ones), and resolves with the
 * hydrated result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since Bot API 10.3
 */
trait PassportApi
{
    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The
     * user will not be able to re-submit their Passport to you until the errors are fixed (the
     * contents of the field for which you returned the error must change). Returns True on success.
     * Use this if the data submitted by the user doesn't satisfy the standards your service requires
     * for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a
     * scan shows evidence of tampering, etc. Supply some details in the error message to make sure the
     * user knows how to correct the issues.
     *
     * @param int $user_id User identifier
     * @param list<\Telegram\Parts\PassportElementError|array> $errors A JSON-serialized Array describing
     *        the errors
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setpassportdataerrors
     */
    public function setPassportDataErrors(
        int $user_id,
        array $errors,
    ): PromiseInterface {
        return $this->callApi('setPassportDataErrors', get_defined_vars(), ['Boolean']);
    }
}
