<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:36:03
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;
use dicr\anticaptcha\entity\SpendingStatItem;

/**
 * GetSpendingStatsResponse
 */
class GetSpendingStatsResponse extends AntiCaptchaResponse
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
