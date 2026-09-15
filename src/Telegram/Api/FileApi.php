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
 * Locating and uploading files.
 *
 * Mixed into {@see \Telegram\Telegram} through {@see Methods}. Every method is
 * named exactly as the Bot API names it, takes exactly the fields the Bot API
 * documents (use named arguments for the optional ones), and resolves with the
 * hydrated result.
 *
 * @link https://core.telegram.org/bots/api
 *
 * @since v10.3
 */
trait FileApi
{
    /**
     * Use this method to get basic information about a file and prepare it for downloading. For the
     * moment, bots can download files of up to 20MB in size. On success, a File object is returned.
     * The file can then be downloaded via the link
     * https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the
     * response. It is guaranteed that the link will be valid for at least 1 hour. When the link
     * expires, a new one can be requested by calling getFile again.
     * Note: This function may not preserve the original file name and MIME type. You should save the
     * file's MIME type and name (if available) when the File object is received.
     *
     * @param string $file_id File identifier to get information about
     *
     * @return PromiseInterface<\Telegram\Parts\File>
     *
     * @link https://core.telegram.org/bots/api#getfile
     */
    public function getFile(
        string $file_id,
    ): PromiseInterface {
        return $this->callApi('getFile', get_defined_vars(), ['File']);
    }

    /**
     * Use this method to upload a file with a sticker for later use in the createNewStickerSet,
     * addStickerToSet, or replaceStickerInSet methods (the file can be used multiple times). Returns
     * the uploaded File on success.
     *
     * @param int $user_id User identifier of sticker file owner
     * @param \Telegram\Builders\InputFile $sticker A file with the sticker in .WEBP, .PNG, .TGS, or .WEBM
     *        format. See https://core.telegram.org/stickers for technical requirements. More information on
     *        Sending Files: https://core.telegram.org/bots/api#sending-files
     * @param string $sticker_format Format of the sticker, must be one of "static", "animated", "video"
     *
     * @return PromiseInterface<\Telegram\Parts\File>
     *
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     */
    public function uploadStickerFile(
        int $user_id,
        \Telegram\Builders\InputFile $sticker,
        string $sticker_format,
    ): PromiseInterface {
        return $this->callApi('uploadStickerFile', get_defined_vars(), ['File']);
    }
}
