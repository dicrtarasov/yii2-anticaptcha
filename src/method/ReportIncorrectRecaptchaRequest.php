<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:16
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;

/**
 * ReportIncorrectRecaptchaRequest - пожаловаться на рекапчу
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/632193103/reportIncorrectRecaptcha
 */
class ReportIncorrectRecaptchaRequest extends AntiCaptchaRequest
{
    /** @var int Идентификатор задания полученный в методе createTask */
    public $taskId;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['taskId', 'required'],
            ['taskId', 'integer', 'min' => 1],
            ['taskId', 'filter', 'filter' => 'intval']
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'reportIncorrectRecaptcha';
    }
}
