<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 16:34:33
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Request;

/**
 * ReportIncorrectRecaptchaRequest - пожаловаться на рекапчу
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/632193103/reportIncorrectRecaptcha
 */
class ReportIncorrectRecaptchaRequest extends Request
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
