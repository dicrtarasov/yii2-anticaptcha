<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 02:42:26
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\Task;

use function array_merge;

/**
 * HCaptchaTask - решение капчи hCaptcha.
 *
 * ВАЖНО: hCaptcha ограничивает кол-во задач с 1 IP адреса, примерно 3 штуки на 12 часов.
 * Учитывайте это, когда будете строить систему решения через свои прокси, либо используйте режим без прокси,
 * если это возможно.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/834502682/HCaptchaTask+hCaptcha
 */
class HCaptchaTask extends Task
{
    /** @var string Адрес страницы на которой решается капча */
    public $websiteURL;

    /** @var string Ключ-индентификатор рекапчи на целевой странице. */
    public $websiteKey;

    /** @var string */
    public $proxyType;

    /**
     * @var string IP адрес прокси ipv4/ipv6.
     * Не допускается:
     * - использование имен хостов;
     * - использование прозрачных прокси (там где можно видеть IP клиента);
     * - использование прокси на локальных машинах
     */
    public $proxyAddress;

    /** @var int Порт прокси */
    public $proxyPort;

    /** @var ?string Логин от прокси-сервера */
    public $proxyLogin;

    /** @var ?string Пароль от прокси-сервера */
    public $proxyPassword;

    /**
     * @var string User-Agent браузера, используемый в эмуляции.
     * Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку,
     * требуя обновить браузер.
     */
    public $userAgent;

    /**
     * @var string[]|null Дополнительные cookies которые мы должны использовать во время взаимодействия
     * с целевой страницей.
     */
    public $cookies;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['websiteURL', 'trim'],
            ['websiteURL', 'required'],
            ['websiteURL', 'url'],

            ['websiteKey', 'trim'],
            ['websiteKey', 'required'],

            ['proxyType', 'default', 'value' => self::PROXY_TYPE_HTTP],
            ['proxyType', 'in', 'range' => [
                self::PROXY_TYPE_HTTP, self::PROXY_TYPE_HTTPS, self::PROXY_TYPE_SOCKS4, self::PROXY_TYPE_SOCKS5
            ]],

            ['proxyAddress', 'trim'],
            ['proxyAddress', 'required'],
            ['proxyAddress', 'ip'],

            ['proxyPort', 'required'],
            ['proxyPort', 'integer', 'min' => 1, 'max' => 65535],

            [['proxyLogin', 'proxyPassword'], 'trim'],
            [['proxyLogin', 'proxyPassword'], 'default'],

            ['userAgent', 'trim'],
            ['userAgent', 'required'],

            ['cookies', 'default']
        ]);
    }
}
