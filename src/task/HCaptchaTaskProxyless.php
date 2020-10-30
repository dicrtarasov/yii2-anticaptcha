<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:33:36
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\AntiCaptchaTask;

use function array_merge;

/**
 * HCaptchaTaskProxyless - решение капчи hCaptcha без прокси
 *
 * ВАЖНО: hCaptcha ограничивает кол-во задач с 1 IP адреса, примерно 3 штуки на 12 часов.
 * Учитывайте это, когда будете строить систему решения через свои прокси, либо используйте режим без прокси,
 * если это возможно.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/834535458/HCaptchaTaskProxyless+hCaptcha
 */
class HCaptchaTaskProxyless extends AntiCaptchaTask
{
    /** @var string Адрес страницы на которой решается капча */
    public $websiteURL;

    /** @var string Ключ-индентификатор рекапчи на целевой странице. */
    public $websiteKey;

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
        ]);
    }
}
