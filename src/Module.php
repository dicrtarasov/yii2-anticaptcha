<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 03:07:39
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\http\HttpCompressionBehavior;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;

use function is_callable;

/**
 * Модуль анти-капчи.
 *
 * @property-read Client $httpClient
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196633
 */
class Module extends \yii\base\Module
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

    /** @var ?callback */
    public $handler;

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init() : void
    {
        parent::init();

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
}
