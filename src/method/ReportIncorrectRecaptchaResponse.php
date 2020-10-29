<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 16:32:10
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * ReportIncorrectRecaptchaResponse
 */
class ReportIncorrectRecaptchaResponse extends Response
{
    /** @var ?string (STATUS_*) */
    public $status;
}
