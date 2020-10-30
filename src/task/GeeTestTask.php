<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:33:09
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\AntiCaptchaTask;

use function array_merge;

/**
 * GeeTestTask - капча от geetest.com
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/416907286/GeeTestTask+-+geetest.com
 */
class GeeTestTask extends AntiCaptchaTask
{
    /** @var string Адрес страницы на которой решается капча */
    public $websiteURL;

    /** @var string Ключ-индентификатор капчи на целевой странице. */
    public $gt;

    /** @var string Переменный токен который необходимо обновлять каждый раз перед созданием задачи. */
    public $challenge;

    /**
     * @var ?string Опциональный поддомен API. Может понадобиться для некоторых инсталляций.
     * Посмотрите исходный код и найдите функцию initGeetest.
     * Если один из ее параметров содержит поле api_server, то пришлите его значение в наше API.
     */
    public $geetestApiServerSubdomain;

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

            ['gt', 'trim'],
            ['gt', 'required'],

            ['challenge', 'trim'],
            ['challenge', 'required'],

            ['geetestApiServerSubdomain', 'trim'],
            ['geetestApiServerSubdomain', 'default'],

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
