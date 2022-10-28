<?php

namespace App\Models;

use App\Contracts\ITVSeries;
use App\Models\TVSeriesIntervals;

class TVSeriesIntervals
{
    private $tv_series;
    private $week_day;
    private $show_time;

    public function __construct(ITVSeries $tv_series, $week_day, $show_time)
    {
        $this->tv_series = $tv_series;
        $this->week_day = $week_day;
        $this->show_time = $show_time;
    }


    public function getWeekDay()
    {
        return $this->week_day;
    }


    public function getTVSeries()
    {
        return $this->tv_series;
    }

    public function getShowTime()
    {
        return $this->show_time;
    }
}
