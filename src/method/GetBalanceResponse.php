<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:31:51
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * Ответ на запрос баланса.
 */
class GetBalanceResponse extends AntiCaptchaResponse
{
    /** @var ?float */
    public $balance;
}
