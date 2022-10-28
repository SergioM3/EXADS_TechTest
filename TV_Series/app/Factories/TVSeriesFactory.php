<?php

namespace App\Factories;

use App\Contracts\ITVSeriesFactory;
use App\Models\TVSeries;

class TVSeriesFactory implements ITVSeriesFactory
{
    public function create($id, $title, $channel, $gender)
    {
        return new TvSeries($id, $title, $channel, $gender);
    }
}
