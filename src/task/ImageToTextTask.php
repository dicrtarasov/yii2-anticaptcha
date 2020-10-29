<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 02:12:40
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\task;

use dicr\anticaptcha\Task;

/**
 * ImageToTextTask - решение обычной капчи с текстом.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/4227078/ImageToTextTask
 */
class ImageToTextTask extends Task
{
    /**
     * @var string Содержимое файла капчи закодированное в base64.
     * Убедитесь что шлете его без переносов строки.
     */
    public $body;

    /** @var ?bool текст с одним или несколькими пробелами */
    public $phrase;

    /** @var ?bool ответ необходимо вводить с учетом регистра */
    public $case;

    /** @var ?int цифры/буквы (NUMERIC_*) */
    public $numeric;

    /** @var ?bool на капче изображено математическое выражение и необходимо ввести на него ответ */
    public $math;

    /** @var ?int минимальная длина ответа */
    public $minLength;

    /** @var ?int максимальная длина ответа */
    public $maxLength;

    /** @var ?string Дополнительный комментарий к капче на английском языке, напр. "enter letters in red color". */
    public $comment;

    /**
     * @var ?string Опциональный параметр для последующего определения источника
     * капч в статистике пользователя.
     */
    public $websiteURL;

    /**
     * @inheritDoc
     */
    public function rules() : array
    {
        return array_merge(parent::rules(), [
            ['body', 'trim'],
            ['body', 'required'],

            [['phrase', 'case', 'math'], 'default'],
            [['phrase', 'case', 'math'], 'boolean'],
            [['phrase', 'case', 'math'], 'filter', 'filter' => 'boolval', 'skipOnEmpty' => true],

            ['numeric', 'default'],
            ['numeric', 'integer', 'min' => 0, 'max' => self::NUMERIC_NO],
            ['numeric', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            [['minLength', 'maxLength'], 'default'],
            [['minLength', 'maxLength'], 'integer', 'min' => 0, 'max' => 20],
            [['minLength', 'maxLength'], 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['comment', 'trim'],
            ['comment', 'default'],

            ['websiteURL', 'trim'],
            ['websiteURL', 'default'],
            ['websiteURL', 'url']
        ]);
    }
}
