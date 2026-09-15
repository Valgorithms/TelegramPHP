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
 * The bot's own identity and settings - its name, descriptions, command list, default rights,
 * profile photo, and the managed-bot endpoints.
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
trait BotApi
{
    /**
     * Use this method to close the bot instance before moving it from one local server to another. You
     * need to delete the webhook before calling this method to ensure that the bot isn't launched
     * again after server restart. The method will return error 429 in the first 10 minutes after the
     * bot is launched. Returns True on success. Requires no parameters.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#close
     */
    public function close(): PromiseInterface
    {
        return $this->callApi('close', [], ['Boolean']);
    }

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language.
     * After deletion, higher level commands will be shown to affected users. Returns True on success.
     *
     * @param \Telegram\Parts\BotCommandScope|array|null $scope Optional. A JSON-serialized object,
     *        describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code. If empty, commands
     *        will be applied to all users from the given scope, for whose language there are no dedicated
     *        commands.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#deletemycommands
     */
    public function deleteMyCommands(
        array|\JsonSerializable|null $scope = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('deleteMyCommands', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the
     * default menu button. Returns MenuButton on success.
     *
     * @param int|null $chat_id Optional. Unique identifier for the target private chat. If not specified,
     *        the bot's default menu button will be returned.
     *
     * @return PromiseInterface<\Telegram\Parts\MenuButton>
     *
     * @link https://core.telegram.org/bots/api#getchatmenubutton
     */
    public function getChatMenuButton(
        ?int $chat_id = null,
    ): PromiseInterface {
        return $this->callApi('getChatMenuButton', get_defined_vars(), ['MenuButton']);
    }

    /**
     * Use this method to get the access settings of a managed bot. Returns a BotAccessSettings object
     * on success.
     *
     * @param int $user_id User identifier of the managed bot whose access settings will be returned
     *
     * @return PromiseInterface<\Telegram\Parts\BotAccessSettings>
     *
     * @link https://core.telegram.org/bots/api#getmanagedbotaccesssettings
     */
    public function getManagedBotAccessSettings(
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('getManagedBotAccessSettings', get_defined_vars(), ['BotAccessSettings']);
    }

    /**
     * Use this method to get the token of a managed bot. Returns the token as String on success.
     *
     * @param int $user_id User identifier of the managed bot whose token will be returned
     *
     * @return PromiseInterface<string>
     *
     * @link https://core.telegram.org/bots/api#getmanagedbottoken
     */
    public function getManagedBotToken(
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('getManagedBotToken', get_defined_vars(), ['String']);
    }

    /**
     * A simple method for testing your bot's authentication token. Requires no parameters. Returns
     * basic information about the bot in form of a User object.
     *
     * @return PromiseInterface<\Telegram\Parts\User>
     *
     * @link https://core.telegram.org/bots/api#getme
     */
    public function getMe(): PromiseInterface
    {
        return $this->callApi('getMe', [], ['User']);
    }

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user
     * language. Returns an Array of BotCommand objects. If commands aren't set, an empty list is
     * returned.
     *
     * @param \Telegram\Parts\BotCommandScope|array|null $scope Optional. A JSON-serialized object,
     *        describing scope of users. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code or an empty string
     *
     * @return PromiseInterface<\Discord\Helpers\Collection<\Telegram\Parts\BotCommand>>
     *
     * @link https://core.telegram.org/bots/api#getmycommands
     */
    public function getMyCommands(
        array|\JsonSerializable|null $scope = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('getMyCommands', get_defined_vars(), ['Array of BotCommand']);
    }

    /**
     * Use this method to get the current default administrator rights of the bot. Returns
     * ChatAdministratorRights on success.
     *
     * @param bool|null $for_channels Optional. Pass True to get default administrator rights of the bot in
     *        channels. Otherwise, default administrator rights of the bot for groups and supergroups will be
     *        returned.
     *
     * @return PromiseInterface<\Telegram\Parts\ChatAdministratorRights>
     *
     * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
     */
    public function getMyDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): PromiseInterface {
        return $this->callApi('getMyDefaultAdministratorRights', get_defined_vars(), ['ChatAdministratorRights']);
    }

    /**
     * Use this method to get the current bot description for the given user language. Returns
     * BotDescription on success.
     *
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code or an empty string
     *
     * @return PromiseInterface<\Telegram\Parts\BotDescription>
     *
     * @link https://core.telegram.org/bots/api#getmydescription
     */
    public function getMyDescription(
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('getMyDescription', get_defined_vars(), ['BotDescription']);
    }

    /**
     * Use this method to get the current bot name for the given user language. Returns BotName on
     * success.
     *
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code or an empty string
     *
     * @return PromiseInterface<\Telegram\Parts\BotName>
     *
     * @link https://core.telegram.org/bots/api#getmyname
     */
    public function getMyName(
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('getMyName', get_defined_vars(), ['BotName']);
    }

    /**
     * Use this method to get the current bot short description for the given user language. Returns
     * BotShortDescription on success.
     *
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code or an empty string
     *
     * @return PromiseInterface<\Telegram\Parts\BotShortDescription>
     *
     * @link https://core.telegram.org/bots/api#getmyshortdescription
     */
    public function getMyShortDescription(
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('getMyShortDescription', get_defined_vars(), ['BotShortDescription']);
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You
     * must log out the bot before running it locally, otherwise there is no guarantee that the bot
     * will receive updates. After a successful call, you can immediately log in on a local server, but
     * will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on
     * success. Requires no parameters.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#logout
     */
    public function logOut(): PromiseInterface
    {
        return $this->callApi('logOut', [], ['Boolean']);
    }

    /**
     * Removes the profile photo of the bot. Requires no parameters. Returns True on success.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#removemyprofilephoto
     */
    public function removeMyProfilePhoto(): PromiseInterface
    {
        return $this->callApi('removeMyProfilePhoto', [], ['Boolean']);
    }

    /**
     * Use this method to revoke the current token of a managed bot and generate a new one. Returns the
     * new token as String on success.
     *
     * @param int $user_id User identifier of the managed bot whose token will be replaced
     *
     * @return PromiseInterface<string>
     *
     * @link https://core.telegram.org/bots/api#replacemanagedbottoken
     */
    public function replaceManagedBotToken(
        int $user_id,
    ): PromiseInterface {
        return $this->callApi('replaceManagedBotToken', get_defined_vars(), ['String']);
    }

    /**
     * Use this method to change the bot's menu button in a private chat, or the default menu button.
     * Returns True on success.
     *
     * @param int|null $chat_id Optional. Unique identifier for the target private chat. If not specified,
     *        the bot's default menu button will be changed.
     * @param \Telegram\Parts\MenuButton|array|null $menu_button Optional. A JSON-serialized object for the
     *        bot's new menu button. Defaults to MenuButtonDefault.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setchatmenubutton
     */
    public function setChatMenuButton(
        ?int $chat_id = null,
        array|\JsonSerializable|null $menu_button = null,
    ): PromiseInterface {
        return $this->callApi('setChatMenuButton', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the access settings of a managed bot. Returns True on success.
     *
     * @param int $user_id User identifier of the managed bot whose access settings will be changed
     * @param bool $is_access_restricted Pass True if only selected users can access the bot. The bot's
     *        owner can always access it.
     * @param list<int>|null $added_user_ids Optional. A JSON-serialized list of up to 10 identifiers of
     *        users who will have access to the bot in addition to its owner. Ignored if is_access_restricted is
     *        False.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmanagedbotaccesssettings
     */
    public function setManagedBotAccessSettings(
        int $user_id,
        bool $is_access_restricted,
        ?array $added_user_ids = null,
    ): PromiseInterface {
        return $this->callApi('setManagedBotAccessSettings', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the list of the bot's commands. See this manual for more details about
     * bot commands. Returns True on success.
     *
     * @param list<\Telegram\Parts\BotCommand|array> $commands A JSON-serialized list of bot commands to be
     *        set as the list of the bot's commands. At most 100 commands can be specified.
     * @param \Telegram\Parts\BotCommandScope|array|null $scope Optional. A JSON-serialized object,
     *        describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code. If empty, commands
     *        will be applied to all users from the given scope, for whose language there are no dedicated
     *        commands.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmycommands
     */
    public function setMyCommands(
        array $commands,
        array|\JsonSerializable|null $scope = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('setMyCommands', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the default administrator rights requested by the bot when it's added
     * as an administrator to groups or channels. These rights will be suggested to users, but they are
     * free to modify the list before adding the bot. Returns True on success.
     *
     * @param \Telegram\Parts\ChatAdministratorRights|array|null $rights Optional. A JSON-serialized object
     *        describing new default administrator rights. If not specified, the default administrator rights will
     *        be cleared.
     * @param bool|null $for_channels Optional. Pass True to change the default administrator rights of the
     *        bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups
     *        will be changed.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
     */
    public function setMyDefaultAdministratorRights(
        array|\JsonSerializable|null $rights = null,
        ?bool $for_channels = null,
    ): PromiseInterface {
        return $this->callApi('setMyDefaultAdministratorRights', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the bot's description, which is shown in the chat with the bot if the
     * chat is empty. Returns True on success.
     *
     * @param string|null $description Optional. New bot description; 0-512 characters. Pass an empty
     *        string to remove the dedicated description for the given language.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code. If empty, the
     *        description will be applied to all users for whose language there is no dedicated description.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmydescription
     */
    public function setMyDescription(
        ?string $description = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('setMyDescription', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the bot's name. Returns True on success.
     *
     * @param string|null $name Optional. New bot name; 0-64 characters. Pass an empty string to remove the
     *        dedicated name for the given language.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code. If empty, the name
     *        will be shown to all users for whose language there is no dedicated name.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmyname
     */
    public function setMyName(
        ?string $name = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('setMyName', get_defined_vars(), ['Boolean']);
    }

    /**
     * Changes the profile photo of the bot. Returns True on success.
     *
     * @param \Telegram\Parts\InputProfilePhoto|array $photo The new profile photo to set
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmyprofilephoto
     */
    public function setMyProfilePhoto(
        array|\JsonSerializable $photo,
    ): PromiseInterface {
        return $this->callApi('setMyProfilePhoto', get_defined_vars(), ['Boolean']);
    }

    /**
     * Use this method to change the bot's short description, which is shown on the bot's profile page
     * and is sent together with the link when users share the bot. Returns True on success.
     *
     * @param string|null $short_description Optional. New short description for the bot; 0-120 characters.
     *        Pass an empty string to remove the dedicated short description for the given language.
     * @param string|null $language_code Optional. A two-letter ISO 639-1 language code. If empty, the
     *        short description will be applied to all users for whose language there is no dedicated short
     *        description.
     *
     * @return PromiseInterface<bool>
     *
     * @link https://core.telegram.org/bots/api#setmyshortdescription
     */
    public function setMyShortDescription(
        ?string $short_description = null,
        ?string $language_code = null,
    ): PromiseInterface {
        return $this->callApi('setMyShortDescription', get_defined_vars(), ['Boolean']);
    }
}
