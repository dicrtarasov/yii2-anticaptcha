<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 16:46:37
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\entity;

use dicr\json\JsonEntity;

/**
 * Элемент отчета по расходам.
 */
class SpendingStatItem extends JsonEntity
{
    /** @var int временной штамп начала периода записи */
    public $dateFrom;

    /** @var int временной штамп окончания периода записи */
    public $dateTill;

    /** @var int количество задач */
    public $volume;

    /** @var float деньги потраченные на задачи */
    public $money;

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        return [];
    }
}
