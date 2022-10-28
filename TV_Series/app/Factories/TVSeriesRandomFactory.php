<?php

namespace App\Factories;

use App\Contracts\ITVSeriesFactory;
use App\Models\TVSeries;

class TVSeriesRandomFactory implements ITVSeriesFactory
{
    public function create($id = "", $title = "", $channel = "", $gender = "")
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));

        $id = $faker->uuid();
        $title = $faker->tvShow;
        $channel = $faker->tvNetwork;
        $gender = $faker->randomElement(['male', 'female']);

        return new TvSeries($id, $title, $channel, $gender);
    }
}
