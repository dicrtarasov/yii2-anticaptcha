<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:41
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * Ответ на запрос создания задачи.
 */
class CreateTaskResponse extends AntiCaptchaResponse
{
    /** @var ?int Идентификатор задания для последующего использования в методе getTask. */
    public $taskId;
}
