<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 03:24:53
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\json\JsonEntity;
use dicr\validate\ValidateException;
use Yii;
use yii\base\Exception;
use yii\httpclient\Client;

/**
 * Запрос.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/578453521/API
 */
abstract class Request extends JsonEntity
{
    /** @var Module $module */
    protected $module;

    /**
     * Request constructor.
     *
     * @param Module $module
     * @param array $config
     */
    public function __construct(Module $module, array $config = [])
    {
        $this->module = $module;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        return [];
    }

    /**
     * Метод API.
     *
     * @return string
     */
    abstract public static function method() : string;

    /**
     * Отправка запроса.
     *
     * @return array json data (переопределяется в наследнике)
     * @throws Exception
     * @noinspection PhpMissingReturnTypeInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function send()
    {
        if (! $this->validate()) {
            throw new ValidateException($this);
        }

        $data = array_filter($this->getJson(), static function ($val) : bool {
            return $val !== null && $val !== '' && $val !== [];
        });

        $data['clientKey'] = $this->module->clientKey;

        $req = $this->module->httpClient->post(static::method(), $data);
        $req->format = Client::FORMAT_JSON;

        Yii::debug('Запрос: ' . $req->toString(), __METHOD__);
        $res = $req->send();
        Yii::debug('Ответ: ' . $res->toString(), __METHOD__);

        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $res->format = Client::FORMAT_JSON;

        return $res->data;
    }
}
