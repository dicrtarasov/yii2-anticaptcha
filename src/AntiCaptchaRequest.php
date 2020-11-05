<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 05.11.20 05:26:41
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
abstract class AntiCaptchaRequest extends JsonEntity
{
    /** @var AntiCaptchaModule $module */
    protected $module;

    /**
     * Request constructor.
     *
     * @param AntiCaptchaModule $module
     * @param array $config
     */
    public function __construct(AntiCaptchaModule $module, array $config = [])
    {
        $this->module = $module;

        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function attributeFields() : array
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

        $data = array_filter(array_merge($this->json, [
            'clientKey' => $this->module->clientKey
        ]), static function ($val) : bool {
            return $val !== null && $val !== '' && $val !== [];
        });

        $req = $this->module->httpClient->post(static::method(), $data);
        $req->format = Client::FORMAT_JSON;

        Yii::debug('Запрос: ' . $req->toString(), __METHOD__);
        $res = $req->send();

        Yii::debug('Ответ: ' . $res->toString(), __METHOD__);
        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $res->format = Client::FORMAT_JSON;
        if (! empty($res->data['errorId'])) {
            throw new Exception('Ошибка: ' . $res->data['errorDescription'] ?? $res->data['errorCode']);
        }

        return $res->data;
    }
}
