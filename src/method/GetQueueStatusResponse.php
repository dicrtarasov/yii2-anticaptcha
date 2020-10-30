<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:57
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * Ответ на запрос статуса очереди.
 */
class GetQueueStatusResponse extends AntiCaptchaResponse
{
    /** @var ?int Количество свободных работников на линии, ожидающих задание */
    public $waiting;

    /** @var ?float Загрузка очереди в процентах */
    public $load;

    /** @var ?float Средняя стоимость решения одной задачи в USD */
    public $bid;

    /** @var ?float Средняя скорость выполнения задания в секундах */
    public $speed;

    /** @var ?int Общее количество работников на линии */
    public $total;
}
