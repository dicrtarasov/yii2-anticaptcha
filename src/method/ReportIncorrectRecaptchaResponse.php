<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:32:28
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * ReportIncorrectRecaptchaResponse
 */
class ReportIncorrectRecaptchaResponse extends AntiCaptchaResponse
{
    /** @var ?string (STATUS_*) */
    public $status;
}
