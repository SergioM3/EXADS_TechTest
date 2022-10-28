<?php

namespace App\Contracts;

interface ITVSeriesFactory
{
    public function create($id, $title, $channel, $gender);
}
