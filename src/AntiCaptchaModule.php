<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:29:51
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\http\HttpCompressionBehavior;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\httpclient\Client;

use function is_callable;

/**
 * Модуль анти-капчи.
 *
 * @property-read Client $httpClient
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196633
 */
class AntiCaptchaModule extends Module
{
    /** @var string API URL */
    public const URL = 'https://api.anti-captcha.com';

    /** @var string API URL */
    public $url = self::URL;

    /** @var string ключ API */
    public $clientKey;

    /**
     * @var ?int Идентификатор приложения из AppCenter, необходимо для получения разработчиками 10% с трат клиентов.
     * @link https://anti-captcha.com/clients/tools/appcenter/top
     */
    public $softId;

    /** @var ?callback function(GetTaskResponse $response) обработка callback-решений задач */
    public $handler;

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init() : void
    {
        parent::init();

        $this->controllerNamespace = __NAMESPACE__;

        if (empty($this->url)) {
            throw new InvalidConfigException('url');
        }

        if (empty($this->clientKey)) {
            throw new InvalidConfigException('clientKey');
        }

        if ($this->handler !== null && ! is_callable($this->handler)) {
            throw new InvalidConfigException('handler');
        }
    }

    /** @var Client */
    private $_httpClient;

    /**
     * HTTP-клиент.
     *
     * @return Client
     */
    public function getHttpClient() : Client
    {
        if ($this->_httpClient === null) {
            $this->_httpClient = new Client([
                'as compression' => HttpCompressionBehavior::class
            ]);
        }

        $this->_httpClient->baseUrl = $this->url;

        return $this->_httpClient;
    }

    /**
     * Создает запрос.
     *
     * @param array $config конфиг объекта, конкретный класс указывается в class
     * @return AntiCaptchaRequest
     * @throws InvalidConfigException
     */
    public function request(array $config) : AntiCaptchaRequest
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::createObject($config, [$this]);
    }
}
