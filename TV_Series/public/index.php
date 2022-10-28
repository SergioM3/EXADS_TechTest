<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Services\TvSeriesService;
use App\Services\DatabaseService;

$viewScript = false;
$filterDate = null;
$filterTVShow = null;
$viewDebugList = false;
$useDatabase = true;

/**
 * The first draft of this, was made without a Database, therefor I decided to leave it here available
 * without DB for debuging purposes
 */

if ($useDatabase) {
     DatabaseService::GenerateDatabase($viewScript, 20, 5);
     $airTimes = DatabaseService::GetGrid();
} else {
    $airTimes = TVSeriesService::RandomPopulateGrid(100, 30); // Test Without Database
}


$nextShow = TVSeriesService::GetNextShow($airTimes, $filterDate, $filterTVShow);
echo 'Next TV Show : <br>';
if (isset($nextShow)) {
     echo '<b style="color:red">' . $nextShow->getTvSeries()->getTitle() . " | " .
                              $nextShow->getTvSeries()->getChannel() . " | " .
                              $nextShow->getWeekDay() . " | " .
                              $nextShow->getShowTime() . '</b><br><br>';
} else {
    echo "No TV Series Airing Found<br><br>";
}


if ($viewDebugList) {
    for ($i = 0; $i < sizeof($airTimes); $i++) {
         echo $airTimes[$i]->getTvSeries()->getTitle() . " | " .
         $airTimes[$i]->getTvSeries()->getChannel() . " | " .
         $airTimes[$i]->getWeekDay() . " | " .
         $airTimes[$i]->getShowTime() . '</b><br>';
    }
}
