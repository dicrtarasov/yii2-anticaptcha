<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:32:33
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaResponse;

/**
 * Class SendFundsResponse
 */
class SendFundsResponse extends AntiCaptchaResponse
{
    /** @var float Оставшаяся сумма на счете клиента */
    public $balanceLeft;
}
