<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:32:55
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\AntiCaptchaTask;

use function array_merge;

/**
 * FunCaptchaTask - крутящаяся капча funcaptcha.com
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/65634354/FunCaptchaTask+-+funcaptcha.com
 */
class FunCaptchaTask extends AntiCaptchaTask
{
    /**
     * @var string Адрес страницы на которой решается капча
     */
    public $websiteURL;

    /**
     * @var ?string Специальный субдомен funcaptcha.com, с которого должен загружаться JS виджет капчи.
     * Большинство инсталляций фанкапчи работают с общих доменов, поэтому этот параметр нужен только в
     * определенных редких случаях.
     */
    public $funcaptchaApiJSSubdomain;

    /**
     * @var ?string Дополнительный параметр, который может требоваться для некоторых решений фанкапчи.
     * Используйте это свойство для передачи параметра blob в виде массива, сведенного в строку.
     * {"blob":"HERE_COMES_THE_blob_VALUE"}
     */
    public $data;

    /**
     * @var string Ключ-индентификатор фанкапчи на целевой странице.
     * <div id="funcaptcha" data-pkey="ВОТ_ЭТОТ"></div>
     */
    public $websitePublicKey;

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

            ['funcaptchaApiJSSubdomain', 'trim'],
            ['funcaptchaApiJSSubdomain', 'default'],

            ['data', 'trim'],
            ['data', 'default'],

            ['websitePublicKey', 'trim'],
            ['websitePublicKey', 'required'],

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
