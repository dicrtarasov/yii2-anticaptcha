<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 18:33:42
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * Class SendFundsResponse
 */
class SendFundsResponse extends Response
{
    /** @var float Оставшаяся сумма на счете клиента */
    public $balanceLeft;
}
