<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 04:18:01
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * Class GetTaskResponse
 */
class GetTaskResponse extends Response
{
    /** @var string задача в процессе выполнения */
    public const STATUS_PROCESSING = 'processing';

    /** @var string задача выполнена, решение находится в свойстве solution */
    public const STATUS_READY = 'ready';

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
