<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 16:50:01
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\entity\SpendingStatItem;
use dicr\anticaptcha\Response;

/**
 * GetSpendingStatsResponse
 */
class GetSpendingStatsResponse extends Response
{
    /**
     * @var SpendingStatItem[]|null Массив записей со следующей структурой:
     */
    public $data;

    /**
     * @inheritDoc
     */
    public static function attributeEntities() : array
    {
        return [
            'data' => [SpendingStatItem::class]
        ];
    }
}
