<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:09
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;

/**
 * ReportIncorrectImageCaptchaRequest - пожаловаться на капчу
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/48693249/reportIncorrectImageCaptcha
 */
class ReportIncorrectImageCaptchaRequest extends AntiCaptchaRequest
{
    /** @var int */
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
        return 'reportIncorrectImageCaptcha';
    }

    /**
     * @inheritDoc
     * @return ReportIncorrectImageCaptchaResponse
     */
    public function send() : ReportIncorrectImageCaptchaResponse
    {
        return new ReportIncorrectImageCaptchaResponse([
            'image' => parent::send()
        ]);
    }
}
