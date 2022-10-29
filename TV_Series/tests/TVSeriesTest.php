<?php 

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Factories\TVSeriesFactory;

class TVSeriesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $tvSeriesFactory = new TVSeriesFactory();
        $this->tvSeries = $tvSeriesFactory->create(1,"Dexter","Netflix","male");
    }

    /** @test */
    public function it_should_get_id()
    {
        $this->assertEquals($this->tvSeries->getId(),1);
    }
    
    /** @test */
    public function it_should_get_title()
    {
        $this->assertEquals($this->tvSeries->getTitle(),"Dexter");
    }

    /** @test */
    public function it_should_get_channel()
    {
        $this->assertEquals($this->tvSeries->getChannel(),"Netflix");
    }

    /** @test */
    public function it_should_get_gender()
    {
        $this->assertEquals($this->tvSeries->getGender(),"male");
    }
}
?>