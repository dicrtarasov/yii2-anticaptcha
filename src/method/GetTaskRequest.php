<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:00
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;

/**
 * Получить результат задачи.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196670/getTaskResult
 */
class GetTaskRequest extends AntiCaptchaRequest
{
    /** @var int Идентификатор задания полученный в методе createTask */
    public $taskId;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return [
            ['taskId', 'required'],
            ['taskId', 'integer', 'min' => 1]
        ];
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'getTaskResult';
    }

    /**
     * @inheritDoc
     * @return GetTaskResponse
     */
    public function send() : GetTaskResponse
    {
        return new GetTaskResponse([
            'json' => parent::send()
        ]);
    }
}
