<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 18:53:32
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\anticaptcha\method\GetTaskResponse;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use function call_user_func;

/**
 * Контроллер callback.
 *
 * @property-read Module $module
 * @property-read \yii\web\Request $request
 */
class CallbackController extends Controller
{
    /**
     * Индекс.
     *
     * @throws BadRequestHttpException
     */
    public function actionIndex() : void
    {
        if (! $this->request->isPost) {
            throw new BadRequestHttpException('post');
        }

        Yii::info('Callback: ' . $this->request->rawBody, __METHOD__);

        if (! empty($this->module->handler)) {
            call_user_func($this->module->handler, [
                new GetTaskResponse(['json' => $this->request->bodyParams])
            ]);
        }
    }
}
