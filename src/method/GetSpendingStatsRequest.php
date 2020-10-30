<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:30:53
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;

/**
 * GetSpendingStatsRequest - получить статистику трат аккаунта
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/576552992/getSpendingStats
 */
class GetSpendingStatsRequest extends AntiCaptchaRequest
{
    /** @var ?int Unix timestamp начала периода 24-х часового отчета */
    public $date;

    /**
     * @var ?string Имя очереди, может быть найдено в статистике Антикапчи.
     * Если не указано, то возвращается суммированная статистика по всем очередям.
     * Пример:
     * "English ImageToText"
     * "Russian ImageToText"
     * "Recaptcha Proxy-on"
     * "Recaptcha Proxyless"
     * "FunCaptcha",
     * "Funcaptcha Proxyless"
     * "Square Net Task"
     * "GeeTest Proxy-on"
     * "GeeTest Proxyless"
     */
    public $queue;

    /** @var ?string IP с которого шли запросы к API */
    public $ip;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['date', 'default'],
            ['date', 'integer', 'min' => 1],
            ['date', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['queue', 'trim'],
            ['queue', 'default'],

            ['ip', 'default'],
            ['ip', 'ip']
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getJson() : array
    {
        return ['sortId' => $this->module->softId] + parent::getJson();
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'getSpendingStats';
    }

    /**
     * @inheritDoc
     * @return GetSpendingStatsResponse
     */
    public function send() : GetSpendingStatsResponse
    {
        return new GetSpendingStatsResponse([
            'json' => parent::send()
        ]);
    }
}
