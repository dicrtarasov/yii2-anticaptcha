<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.10.20 07:28:54
 */

declare(strict_types = 1);
namespace dicr\anticaptcha;

use dicr\json\JsonEntity;

use function array_merge;
use function count;
use function explode;
use function implode;
use function preg_split;
use function strrpos;

use const PREG_SPLIT_NO_EMPTY;

/**
 * Абстракция задача капчи.
 *
 * @link https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196650
 */
abstract class AntiCaptchaTask extends JsonEntity
{
    /** @var int можно вводить только цифры */
    public const NUMERIC_YES = 1;

    /** @var int вводить можно любые символы кроме цифр */
    public const NUMERIC_NO = 2;

    /** @var string обычный http/https прокси */
    public const PROXY_TYPE_HTTP = 'http';

    /** @var string попробуйте эту опцию только если "http" не работает (требуется для некоторых кастомных прокси) */
    public const PROXY_TYPE_HTTPS = 'https';

    /** @var string socks4 прокси */
    public const PROXY_TYPE_SOCKS4 = 'socks4';

    /** @var string socks5 прокси */
    public const PROXY_TYPE_SOCKS5 = 'socks5';

    /**
     * @inheritDoc
     */
    public static function attributeFields() : array
    {
        // отключаем трансляцию полей
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function attributesToJson() : array
    {
        return array_merge(parent::attributesToJson(), [
            'cookies' => function (?array $value) : ?string {
                $cookies = [];

                foreach ($value ?: [] as $key => $val) {
                    $cookies[] = $key . '=' . $val;
                }

                return implode('; ', $cookies) ?: null;
            }
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function attributesFromJson() : array
    {
        return array_merge(parent::attributesFromJson(), [
            'cookies' => function (?string $data) : ?array {
                $cookies = [];
                $items = (array)preg_split('~\;\s*~u', (string)$data, -1, PREG_SPLIT_NO_EMPTY);

                foreach ($items as $item) {
                    $parts = (array)explode('=', $item, 2);
                    if (count($parts) === 2) {
                        $cookies[$parts[0]] = $parts[1];
                    }
                }

                return $cookies ?: null;
            }
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getJson() : array
    {
        $class = static::class;

        $pos = strrpos($class, '\\');
        if ($pos) {
            $class = substr($class, $pos + 1);
        }

        return ['type' => $class] + parent::getJson();
    }
}
