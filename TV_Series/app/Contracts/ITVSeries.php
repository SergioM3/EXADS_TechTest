<?php

namespace App\Contracts;

interface ITVSeries
{
    public function __construct($id, $title, $channel, $gender);
    public function getTitle();
}
