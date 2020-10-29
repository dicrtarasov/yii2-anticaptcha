<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.10.20 18:28:46
 */

declare(strict_types = 1);
namespace dicr\anticaptcha\method;

use dicr\anticaptcha\Response;

/**
 * GetAppStatsResponse
 */
class GetAppStatsResponse extends Response
{
    /**
     * @var array Массив из структур, в которых содержатся названия данных, значения, даты и т.д.
     * Данные готовы для отображения с помощью HighCharts
     */
    public $chartData;

    /** @var string Начальная дата отчета */
    public $fromDate;

    /** @var string Конечная дата отчета */
    public $toDate;
}
