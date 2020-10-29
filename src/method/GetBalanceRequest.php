<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 15:58:16
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Request;

/**
 * GetBalanceRequest - получение баланса
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/6389789/getBalance
 */
class GetBalanceRequest extends Request
{
    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'getBalance';
    }

    /**
     * @inheritDoc
     * @return GetBalanceResponse
     */
    public function send() : GetBalanceResponse
    {
        return new GetBalanceResponse([
            'json' => parent::send()
        ]);
    }
}
