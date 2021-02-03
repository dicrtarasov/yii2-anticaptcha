<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 03.02.21 20:29:10
 */

declare(strict_types = 1);
namespace dicr\tests;

use dicr\anticaptcha\AntiCaptchaModule;
use dicr\anticaptcha\method\CreateTaskRequest;
use dicr\anticaptcha\method\GetBalanceRequest;
use dicr\anticaptcha\task\ImageToTextTask;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\base\Exception;

use function base64_encode;
use function file_get_contents;

/**
 * Class ReceiptTest
 */
class MethodTest extends TestCase
{
    /**
     * Модуль.
     *
     * @return AntiCaptchaModule
     */
    private static function module(): AntiCaptchaModule
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::$app->getModule('anticaptcha');
    }

    /**
     * @throws Exception
     * @noinspection PhpUnitMissingTargetForTestInspection
     */
    public function testBalanceRequest(): void
    {
        /** @var GetBalanceRequest $req */
        $req = self::module()->request([
            'class' => GetBalanceRequest::class,
        ]);

        $res = $req->send();
        self::assertIsNumeric($res->balance);
        echo 'Баланс: ' . $res->balance . "\n";
    }

    /**
     * @throws Exception
     * @noinspection PhpUnitMissingTargetForTestInspection
     */
    public function testCreateTask(): void
    {
        /** @var CreateTaskRequest $req */
        $req = self::module()->request([
            'class' => CreateTaskRequest::class,
            'task' => new ImageToTextTask([
                'body' => base64_encode(file_get_contents(__DIR__ . '/captcha.gif')),
            ])
        ]);

        $res = $req->send();

        self::assertIsNumeric($res->taskId);
        echo 'Задача: ' . $res->taskId . "\n";
    }
}
