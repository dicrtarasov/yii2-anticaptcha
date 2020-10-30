<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:30:47
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;

/**
 * GetQueueStatusRequest - получить информацию о загрузке очереди
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/8290314/getQueueStats
 */
class GetQueueStatusRequest extends AntiCaptchaRequest
{
    /** @var int стандартная ImageToText, язык английский */
    public const QUEUE_IMAGETOTEXT_EN = 1;

    /** @var int  стандартная ImageToText, язык русский */
    public const QUEUE_IMAGETOTEXT_RU = 2;

    /** @var int Recaptcha NoCaptcha */
    public const QUEUE_RECAPTCHA_NOCAPTCHA = 5;

    /** @var int Recaptcha Proxyless */
    public const QUEUE_RECAPTCHA_PROXYLESS = 6;

    /** @var int Funcaptcha */
    public const QUEUE_FUNCAPTCHA_PROXY = 7;

    /** @var int Funcaptcha Proxyless */
    public const QUEUE_FUNCAPTCHA_PROXYLESS = 10;

    /** @var int Square Net Task */
    public const QUEUE_SQUARENETTASK = 11;

    /** @var int GeeTest Proxy-On */
    public const QUEUE_GEETEST_PROXYON = 12;

    /** @var int GeeTest Proxyless */
    public const QUEUE_GEETEST_PROXYLESS = 13;

    /** @var int Recaptcha V3 s0.3 */
    public const QUEUE_RECAPTCHA3_03 = 18;

    /** @var int Recaptcha V3 s0.7 */
    public const QUEUE_RECAPTCHA3_07 = 19;

    /** @var int Recaptcha V3 s0.9 */
    public const QUEUE_RECAPTCHA3_09 = 20;

    /** @var int hCaptcha Proxy-On */
    public const QUEUE_HCAPTCHA_PROXYON = 21;

    /** @var int hCaptcha Proxyless */
    public const QUEUE_HCAPTCHA_PROXYLESS = 22;

    /** @var ?int Номер очереди (QUEUE_*) */
    public $queueId;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['queueId', 'default'],
            ['queueId', 'integer', 'min' => 1],
            ['queueId', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true]
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'getQueueStats';
    }

    /**
     * @inheritDoc
     * @return GetQueueStatusResponse
     */
    public function send() : GetQueueStatusResponse
    {
        return new GetQueueStatusResponse([
            'json' => parent::send()
        ]);
    }
}
