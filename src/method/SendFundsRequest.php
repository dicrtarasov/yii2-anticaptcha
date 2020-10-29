<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 18:38:29
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Request;

use function array_merge;

/**
 * SendFundsRequest - отправить средства другому пользователю
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/634552328/sendFunds
 */
class SendFundsRequest extends Request
{
    /** @var ?string Логин целевого аккаунта */
    public $accountLogin;

    /** @var ?string ИЛИ адрес почты целевого аккаунта */
    public $accountEmail;

    /** @var float */
    public $amount;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            [['accountLogin', 'accountEmail'], 'trim'],
            [['accountLogin', 'accountEmail'], 'default'],

            ['accountEmail', 'email'],
            ['accountEmail', 'required', 'when' => function () : bool {
                return empty($this->accountLogin);
            }]
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'sendFunds';
    }

    /**
     * @inheritDoc
     * @return SendFundsResponse
     */
    public function send() : SendFundsResponse
    {
        return new SendFundsResponse([
            'json' => parent::send()
        ]);
    }
}
