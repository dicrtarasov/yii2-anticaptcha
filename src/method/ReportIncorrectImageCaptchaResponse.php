<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 16:23:41
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * ReportIncorrectImageCaptchaResponse
 */
class ReportIncorrectImageCaptchaResponse extends Response
{
    /** @var ?string (STATUS_*) */
    public $status;
}
