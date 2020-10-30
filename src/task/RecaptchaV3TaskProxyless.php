<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:34:04
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\AntiCaptchaTask;

/**
 * RecaptchaV3TaskProxyless - решение капчи Google версии 3
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/623935506/RecaptchaV3TaskProxyless+Google+3
 */
class RecaptchaV3TaskProxyless extends AntiCaptchaTask
{
    /**
     * @var string Адрес страницы на которой решается капча
     */
    public $websiteURL;

    /**
     * @var string Ключ-индентификатор рекапчи на целевой странице.
     * Берется из HTML этой страницы.
     * https://www.google.com/recaptcha/api.js?render=ВОТ_ЭТОТ
     */
    public $websiteKey;

    /**
     * @var float Определяет фильтр, по которому отбирается работник с нужным минимальным score.
     * Это значение мы определяем на своих тестах для работников раз в 10 минут.
     * Может иметь одно из следующих значений: 0.3, 0.7, 0.9
     */
    public $minScore;

    /**
     * @var ?string Значение параметра action, которое передается виджетом рекапчи в гугл,
     * и которое потом видит владелец сайта при проверке токена.
     * Пример в html: grecaptcha.execute('site_key', {action:'login_test'}).
     */
    public $pageAction;

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

            ['minScore', 'required'],
            ['minScore', 'in', 'range' => [0.3, 0.7, 0.9]],
            ['minScore', 'filter', 'filter' => 'floatval'],

            ['pageAction', 'trim'],
            ['pageAction', 'default']
        ]);
    }
}
