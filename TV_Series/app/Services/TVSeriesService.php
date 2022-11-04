<?php

namespace App\Services;

use App\Factories\TVSeriesRandomFactory;
use App\Models\TVSeriesIntervals;

class TVSeriesService
{
    /**
     * Get Next Show from any Channel of the grid show stored in the array "airTimes"
     *
     * @param TVSeriesIntervals[] $airTimes
     * @param string $fromDateTime
     * @param string $filterTitle
     *
     * @return TVSeriesIntervals
     */
    public static function getNextShow($airTimes, $fromDateTime = null, $filterTitle = null)
    {

        $lastTime = strtotime(date("Y-m-d 23:59:59", strtotime('sunday next week'))); // Needs to be initialized with any date bigger then this week
        $nextShow = null;

        if (!isset($fromDateTime)) {
            $fromDateTime = date("Y-m-d H:i:s");
        }

        $fromDateTime = strtotime($fromDateTime); // Convert input date to time

        // Iterate through "airTimes" Array
        for ($i = 0; $i < sizeof($airTimes); $i++) {
            $showTime = $airTimes[$i]->getShowTime();
            $weekDay  = $airTimes[$i]->getWeekDay();
            $tvSeries = $airTimes[$i]->getTVSeries();
            $title    = $tvSeries->getTitle();

            /**
             * Date Time the show airs this week
             */
            $dayofweek = date('w', $fromDateTime);
            $showDateTime    = strtotime(date('Y-m-d', strtotime((($airTimes[$i]->getWeekDay()) - $dayofweek) . ' day', $fromDateTime))  . " " . $showTime);

            // Filter every "showing" ahead of filtered Datetime and by show title if it's set
            if ($showDateTime >= $fromDateTime && $showDateTime < $lastTime && (!isset($filterTitle) || $filterTitle == $title)) {
                // If found a show with a lower Datetime then the previous found then that is the new "nextShow"
                $nextShow = $airTimes[$i];
                $lastTime = $showDateTime;
            }
        }
        return $nextShow;
    }

    /**
     * RandomlyPopulate TV Grid using the faker library
     *
     * @param integer $nTvShows
     * @param integer $nShowings
     *
     * @return TVSeriesIntervals[]
     */
    public static function randomPopulateGrid($nTvShows = 100, $nShowings = 5)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));

        // Populate Series
        $tvSeries = array();
        $airTimes = array();

        $tvSeriesFactory = new TVSeriesRandomFactory();
        for ($i = 0; $i < $nTvShows; $i++) {
            array_push($tvSeries, $tvSeriesFactory->create());

            // Populate intervals (air time)
            for ($j = 0; $j < $nShowings; $j++) {
                $tvSeriesInterval = new TVSeriesIntervals($tvSeries[$i], $faker->numberBetween(0, 6), $faker->time('H:i:s'));
                array_push($airTimes, $tvSeriesInterval);
            }
        }
        return $airTimes;
    }
}
