<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:34:36
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\AntiCaptchaRequest;
use dicr\anticaptcha\AntiCaptchaTask;
use dicr\helper\Url;

use function array_merge;

/**
 * Запрос создания задачи на решение капчи.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/4227074/createTask
 */
class CreateTaskRequest extends AntiCaptchaRequest
{
    /** @var string англоязычная очередь */
    public const LANGUAGE_EN = 'en';

    /** @var string группа стран Россия, Украина, Беларусь, Казахстан */
    public const LANGUAGE_RN = 'rn';

    /** @var AntiCaptchaTask задача */
    public $task;

    /**
     * @var ?string Определяет язык очереди, в которую должна попасть капча (LANGUAGE_*)
     */
    public $languagePool = self::LANGUAGE_RN;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['task', 'required'],
            ['task', function (string $attribute) {
                if (! $this->task instanceof AntiCaptchaTask) {
                    $this->addError($attribute, 'Должен быть типом Task');
                }
            }],

            ['languagePool', 'trim'],
            ['languagePool', 'default'],
            ['languagePool', 'in', 'range' => [self::LANGUAGE_EN, self::LANGUAGE_RN]]
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function attributeEntities() : array
    {
        return [
            'task' => AntiCaptchaTask::class
        ];
    }

    /**
     * @inheritDoc
     */
    public static function method() : string
    {
        return 'createTask';
    }

    /**
     * @inheritDoc
     */
    public function getJson() : array
    {
        return array_merge(parent::getJson(), [
            'softId' => $this->module->softId,
            'callbackUrl' => $this->module->handler ?
                Url::to($this->module->uniqueId . '/callback', true) : null
        ]);
    }

    /**
     * @inheritDoc
     * @return CreateTaskResponse
     */
    public function send() : CreateTaskResponse
    {
        return new CreateTaskResponse([
            'json' => parent::send()
        ]);
    }
}
