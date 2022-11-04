<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\TVSeriesService;
use App\Factories\TVSeriesFactory;
use App\Models\TVSeriesIntervals;

class TVSeriesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $tvSeriesFactory = new TVSeriesFactory();
        $this->testGrids = array();

        // Grid 1 -- 3 Shows all within same day twice a day seperated by an hour
        $airTimes          = array();

        $tvSeries          = $tvSeriesFactory->create(1, "Dexter", "Netflix", "male");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+1 hour')), date("H:i:s", strtotime('+1 hour'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+2 hours')), date("H:i:s", strtotime('+2 hours'))));

        $tvSeries          = $tvSeriesFactory->create(2, "Supernatural", "Amazon", "male");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+3 hours')), date("H:i:s", strtotime('+3 hours'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+4 hours')), date("H:i:s", strtotime('+4 hours'))));

        $tvSeries          = $tvSeriesFactory->create(3, "Game of Thrones", "HBO", "female");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+5 hours')), date("H:i:s", strtotime('+5 hours'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+6 hours')), date("H:i:s", strtotime('+6 hours'))));

        array_push($this->testGrids, $airTimes);

        // Grid 2 -- 3 Shows  all within same day twice a day seperated by an hour but first show already aired
        $airTimes          = array();

        $tvSeries          = $tvSeriesFactory->create(1, "Twin Peaks", "The CW", "male");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('-1 hours')), date("H:i:s", strtotime('-1 hours'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('-2 hours')), date("H:i:s", strtotime('-2 hours'))));

        $tvSeries          = $tvSeriesFactory->create(2, "Mr. Robot", "AMC", "male");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+1 hour')), date("H:i:s", strtotime('+1 hour'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+2 hours')), date("H:i:s", strtotime('+2 hours'))));

        $tvSeries          = $tvSeriesFactory->create(3, "Sons of Anarchy", "ABC", "female");
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+3 hours')), date("H:i:s", strtotime('+3 hours'))));
        array_push($airTimes, new TVSeriesIntervals($tvSeries, date("w", strtotime('+4 hours')), date("H:i:s", strtotime('+4 hours'))));

        array_push($this->testGrids, $airTimes);
    }

    /** @test */
    public function it_randomly_populates_grid()
    {
        $result = TVSeriesService::randomPopulateGrid(10, 2);

        // Total number of tv_series_intervals should be 20
        $this->assertEquals(sizeof($result), 20);
    }

    /** @test */
    public function next_show_should_be_dexter()
    {
        $result = TVSeriesService::getNextShow($this->testGrids[0]);

         // Next TV Show should be "Dexter"
        $this->assertEquals($result->getTVSeries()->getTitle(), "Dexter");
    }

    /** @test */
    public function next_show_should_be_mrrobot()
    {
        $result = TVSeriesService::getNextShow($this->testGrids[1]);

         // Next TV Show should be "Mr. Robot"
        $this->assertEquals($result->getTVSeries()->getTitle(), "Mr. Robot");
    }

    /** @test */
    public function next_show_should_be_sonsofanarchy()
    {
        $result = TVSeriesService::getNextShow($this->testGrids[1], null, "Sons of Anarchy");

        // Next TV Show should be "Sons of Anarchy"
        $this->assertEquals($result->getTVSeries()->getTitle(), "Sons of Anarchy");
    }

    /** @test */
    public function there_should_be_no_next_show()
    {
        $result = TVSeriesService::getNextShow($this->testGrids[1], date("w"), date("H:i:s", strtotime('+5 hours')));

        // No new TV show coming after filtered time
        $this->assertEquals($result, null);
    }
}
