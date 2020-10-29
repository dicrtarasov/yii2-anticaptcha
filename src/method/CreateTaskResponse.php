<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 03:27:48
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * Ответ на запрос создания задачи.
 */
class CreateTaskResponse extends Response
{
    /** @var ?int Идентификатор задания для последующего использования в методе getTask. */
    public $taskId;
}
