<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:30:32
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;
use yii\base\InvalidConfigException;

/**
 * GetAppStatsRequest - получить статистику приложения
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/578355267/getAppStats
 */
class GetAppStatsRequest extends AntiCaptchaRequest
{
    /** @var string Ошибки */
    public const MODE_ERRORS = 'errors';

    /** @var string Просмотры приложения в App Center */
    public const MODE_VIEWS = 'views';

    /** @var string клики на "скачать" */
    public const MODE_DOWNLOADS = 'downloads';

    /** @var string Количество пользователей */
    public const MODE_USERS = 'users';

    /** @var string Заработанные средства */
    public const MODE_MONEY = 'money';

    /** @var ?string Тип статистики (MODE_*) */
    public $mode;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['mode', 'trim'],
            ['mode', 'default']
        ]);
    }

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function getJson() : array
    {
        if (empty($this->module->softId)) {
            throw new InvalidConfigException('softId');
        }

        return ['softId' => (int)$this->module->softId] + parent::getJson();
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'getAppStats';
    }

    /**
     * @inheritDoc
     * @return GetAppStatsResponse
     */
    public function send() : GetAppStatsResponse
    {
        return new GetAppStatsResponse([
            'json' => parent::send()
        ]);
    }
}
