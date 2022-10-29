<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\TVSeriesIntervals;

class TVSeriesIntervalsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $tvSeries = $this->createMock(\App\Models\TVSeries::class);

        $this->tvSeriesInterval = new TVSeriesIntervals($tvSeries, 1, "17:32:00");
    }

    /** @test */
    public function it_should_get_tv_series()
    {
        $this->assertInstanceOf(\App\Models\TVSeries::class, $this->tvSeriesInterval->getTVSeries());
    }

    /** @test */
    public function it_should_get_weekday()
    {
        $this->assertEquals($this->tvSeriesInterval->getWeekDay(), 1);
    }

    /** @test */
    public function it_should_get_show_time()
    {
        $this->assertEquals($this->tvSeriesInterval->getShowTime(), "17:32:00");
    }
}
