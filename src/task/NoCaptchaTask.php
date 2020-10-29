<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 02:41:58
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\Task;

use function array_merge;

/**
 * NoCaptchaTask - решение капчи Google
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/4227081/NoCaptchaTask+Google
 */
class NoCaptchaTask extends Task
{
    /**
     * @var string Адрес страницы на которой решается капча
     */
    public $websiteURL;

    /**
     * @var string ключ-идентификатор рекапчи на целевой странице.
     * <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div>
     * Есть инструкция как получить этот ключ если его нет в HTML.
     *
     * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/9666585
     */
    public $websiteKey;

    /**
     * @var ?string Секретный токен для предыдущей версии рекапчи.
     * @noinspection SpellCheckingInspection
     *
     * В большинстве случаев сайты используют новую версию и этот токен не требуется.
     * Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken.
     * Выглядит это примерно так:
     * <script type="text/javascript" src="...." data-type="normal"  data-ray="2ef1e98c77332d9b" async
     *     data-sitekey="6LfOYgoTAAAAAInWDVTLSc8Yblab-c9DaLblabla"
     *     data-stoken="urFaI2UjzL9Q4gf4a-aeCNAePAZUuq7nYbX40BVb69aXVq-apf_k-kZ7i-iXE2WxkokWB9rZv-ofOJPjbEh4YN3SyoVrsIorNOpeGSWx2D0">
     * </script>
     * Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его.
     */
    public $websiteSToken;

    /**
     * @var ?string Некоторые реализации виджета рекапчи могут содержать дополнительный
     * параметр "data-s" в div'е рекапчи, который является одноразовым токеном и должен собираться каждый раз при
     * решении рекапчи.
     * <div class="g-recaptcha" data-sitekey="some sitekey" data-s="ВОТ_ЭТОТ"></div>
     * Если вы решаете рекапчу на доменах google.com, и используете безбраузерный подход,
     * то используйте "cookies" которые мы передаем в ответе getTaskResult.
     */
    public $recaptchaDataSValue;

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
     * @var ?bool Указать что рекапча невидимая.
     * Флаг отобразит соответствующий виджет рекапчи у наших работников. В большинстве случаев флаг указывать не нужно,
     * т.к. невидимая рекапча распознается автоматически, но на это требуется несколько десятков задач для
     * обучения системы.
     */
    public $isInvisible;

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

            [['websiteSToken', 'recaptchaDataSValue'], 'trim'],
            [['websiteSToken', 'recaptchaDataSValue'], 'default'],

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

            ['cookies', 'default'],

            ['isInvisible', 'default'],
            ['isInvisible', 'boolean'],
            ['isInvisible', 'filter', 'filter' => 'intval']
        ]);
    }
}
