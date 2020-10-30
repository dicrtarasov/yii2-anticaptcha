<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:32:16
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * ReportIncorrectImageCaptchaResponse
 */
class ReportIncorrectImageCaptchaResponse extends AntiCaptchaResponse
{
    /** @var ?string (STATUS_*) */
    public $status;
}
