<?php

namespace App\Models;

use App\Contracts\ITVSeries;

class TVSeries implements ITVSeries
{
    private $id;
    private $title;
    private $channel;
    private $gender;

    public function __construct($id, $title, $channel, $gender)
    {
        $this->id = $id;
        $this->title = $title;
        $this->channel = $channel;
        $this->gender = $gender;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getGender()
    {
        return $this->gender;
    }
}
