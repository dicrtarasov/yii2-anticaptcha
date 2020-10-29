<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 02:15:36
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\Task;

use function array_merge;

/**
 * FunCaptchaTask - funcaptcha без прокси.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/327024659/FunCaptchaTaskProxyless+-+funcaptcha
 */
class FunCaptchaTaskProxyless extends Task
{
    /**
     * @var string Адрес страницы на которой решается капча
     */
    public $websiteURL;

    /**
     * @var ?string Специальный субдомен funcaptcha.com, с которого должен загружаться JS виджет капчи.
     * Большинство инсталляций фанкапчи работают с общих доменов, поэтому этот параметр нужен только в
     * определенных редких случаях.
     */
    public $funcaptchaApiJSSubdomain;

    /**
     * @var ?string Дополнительный параметр, который может требоваться для некоторых решений фанкапчи.
     * Используйте это свойство для передачи параметра blob в виде массива, сведенного в строку.
     * {"blob":"HERE_COMES_THE_blob_VALUE"}
     */
    public $data;

    /**
     * @var string Ключ-индентификатор фанкапчи на целевой странице.
     * <div id="funcaptcha" data-pkey="ВОТ_ЭТОТ"></div>
     */
    public $websitePublicKey;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['websiteURL', 'trim'],
            ['websiteURL', 'required'],
            ['websiteURL', 'url'],

            ['funcaptchaApiJSSubdomain', 'trim'],
            ['funcaptchaApiJSSubdomain', 'default'],

            ['data', 'trim'],
            ['data', 'default'],

            ['websitePublicKey', 'trim'],
            ['websitePublicKey', 'required'],
        ]);
    }
}
