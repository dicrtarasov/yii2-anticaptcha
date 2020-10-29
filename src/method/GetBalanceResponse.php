<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 15:57:21
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * Ответ на запрос баланса.
 */
class GetBalanceResponse extends Response
{
    /** @var ?float */
    public $balance;
}
