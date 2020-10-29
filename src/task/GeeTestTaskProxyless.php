<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 02:28:00
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\Task;

use function array_merge;

/**
 * GeeTestTaskProxyless - капча от geetest.com без прокси
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/417005605/GeeTestTaskProxyless+-+geetest.com
 */
class GeeTestTaskProxyless extends Task
{
    /** @var string Адрес страницы на которой решается капча */
    public $websiteURL;

    /** @var string Ключ-индентификатор капчи на целевой странице. */
    public $gt;

    /** @var string Переменный токен который необходимо обновлять каждый раз перед созданием задачи. */
    public $challenge;

    /**
     * @var ?string Опциональный поддомен API. Может понадобиться для некоторых инсталляций.
     * Посмотрите исходный код и найдите функцию initGeetest.
     * Если один из ее параметров содержит поле api_server, то пришлите его значение в наше API.
     */
    public $geetestApiServerSubdomain;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['websiteURL', 'trim'],
            ['websiteURL', 'required'],
            ['websiteURL', 'url'],

            ['gt', 'trim'],
            ['gt', 'required'],

            ['challenge', 'trim'],
            ['challenge', 'required'],

            ['geetestApiServerSubdomain', 'trim'],
            ['geetestApiServerSubdomain', 'default']
        ]);
    }
}
