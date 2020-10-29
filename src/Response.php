<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 00:09:56
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\json\JsonEntity;

/**
 * Ответ на запрос.
 */
abstract class Response extends JsonEntity
{
    /** @var string */
    public const STATUS_SUCCESS = 'success';

    /**
     * @var ?int Идентификатор ошибки.
     * 0 - ошибок нет, задача успешно создана, идентификатор задачи находится в параметре taskId
     * >1 - код ошибки, информация об ошибке находится в параметрах errorCode и errorDescription
     */
    public $errorId;

    /**
     * @var ?string Код ошибки.
     * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196679
     */
    public $errorCode;

    /** @var ?string Краткое описание ошибки на английском языке. */
    public $errorDescription;

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        return [];
    }
}