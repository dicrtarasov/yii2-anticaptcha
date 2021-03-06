<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:32:11
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * Class GetTaskResponse
 */
class GetTaskResponse extends AntiCaptchaResponse
{
    /** @var ?string состояние задачи (STATUS_*) */
    public $status;

    /** @var array ответ решения */
    public $solution;

    /** @var ?float Стоимость решения в USD. */
    public $cost;

    /** @var ?string IP адрес с которого пришел запрос на создание задачи. */
    public $ip;

    /** @var ?int UNIX Timestamp создания задачи. */
    public $createTime;

    /** @var ?int UNIX Timestamp завершения задачи. */
    public $endTime;

    /** @var ?int Количество попыток решения задачи разными работниками */
    public $solveCount;
}
