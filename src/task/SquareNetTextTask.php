<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:34:11
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\AntiCaptchaTask;

/**
 * SquareNetTextTask - выбрать нужный объект на картинке с сеткой изображений
 *
 * @package https://anticaptcha.atlassian.net/wiki/spaces/API/pages/410714125/SquareNetTextTask
 */
class SquareNetTextTask extends AntiCaptchaTask
{
    /** @var string Тело файла в base64 и без переносов строки. */
    public $body;

    /** @var string Имя объекта. Пример: banana */
    public $objectName;

    /** @var int Кол-во строк. Min 2, max 5 */
    public $rowsCount;

    /** @var int Кол-во колонок. Min 2, max 5 */
    public $columnsCount;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            [['body', 'objectName'], 'trim'],
            [['body', 'objectName'], 'required'],

            [['rowsCount', 'columnsCount'], 'required'],
            [['rowsCount', 'columnsCount'], 'integer', 'min' => 2, 'max' => 5],
            [['rowsCount', 'columnsCount'], 'filter', 'filter' => 'intval'],
        ]);
    }
}
