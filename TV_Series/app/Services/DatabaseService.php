<?php

namespace App\Services;

use App\Factories\TVSeriesRandomFactory;
use App\Factories\TVSeriesFactory;
use App\Models\TVSeriesIntervals;

class DatabaseService
{
    private static $conn;
    private static $script;

    /**
     * Creates MySQL connection
     *
     * @return mysqli
     */
    private static function createConnection()
    {
        // Create connection
        $conn = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }

    /**
     * Drops & Creates Database
     *
     * @return string
     */
    private static function createDatabase()
    {
        $conn = self::$conn;

        $script = "";

         // Drop Database
        $sql = "drop schema IF EXISTS exadsTechTest;";
        $script .= $sql . '<br>';
        if (!$conn->query($sql) === true) {
            echo "Error creating database: " . $conn->error;
        }

        // Create database
        $sql = "CREATE DATABASE exadsTechTest;";
        $script .= $sql . '<br>';
        if (!$conn->query($sql) === true) {
            echo "Error creating database: " . $conn->error;
        }

        // sql to create table
        $sql = "CREATE TABLE exadsTechTest.tv_series (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(500) NOT NULL,
                    channel VARCHAR(100) NOT NULL,
                    gender VARCHAR(20)  
                );";

        $script .= $sql . '<br>';

        if (!$conn->query($sql) === true) {
             echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE exadsTechTest.tv_series_intervals (
                    id_tv_series INT NOT NULL,
                    weekday int NOT NULL,
                    show_time time NOT NULL,
                    CONSTRAINT fk_tv_series foreign key (id_tv_series) 
                    references exadsTechTest.tv_series(id) ON DELETE CASCADE
                );";


        $script .= $sql . '<br>';

        if (!$conn->query($sql) === true) {
            echo "Error creating table: " . $conn->error;
        }

        return $script;
    }

    /**
     * Populate Database with Random TV Series and Random Intervals
     *
     * @param  int $nTvShows
     * @param  int $nShowings
     * @return string
     */
    private static function populateDatabase($nTvShows, $nShowings)
    {
        $conn = self::$conn;

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));

        $script = "";


        $conn->begin_transaction();
        $script .= 'START TRANSACTION;<br>';

        try {
            $tvSeriesFactory = new TVSeriesRandomFactory();
            for ($i = 0; $i < $nTvShows; $i++) {
                $tvSeries = $tvSeriesFactory->create();

                $query = "INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('" . str_replace("'", "''", $tvSeries->getTitle()) . "', 
                                                                                            '" . str_replace("'", "''", $tvSeries->getChannel()) . "', 
                                                                                            '" . $tvSeries->getGender() . "');";
                $script .= $query . '<br>';
                $conn->query($query);
                // Populate intervals (air time)
                for ($j = 0; $j < $nShowings; $j++) {
                    $tvSeriesInterval = new TVSeriesIntervals($tvSeries, $faker->numberBetween(0, 6), $faker->time('H:i:s'));
                    $query = "INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 
                                                                                                " . $tvSeriesInterval->getWeekDay() . ", 
                                                                                                '" . $tvSeriesInterval->getShowTime() . "');";
                    $script .= $query . '<br>';
                    $conn->query($query);
                }
            }

            $conn->commit();
            $script .= 'COMMIT;<br>';
        } catch (conn $exception) {
            $conn->rollback();

            throw $exception;
        }
        return $script;
    }

    /**
     * Calls all private methods needed to fully generate DB
     *
     * @return void
     */
    public static function generateDatabase($printScript = false, $nTvShows = 10, $nShowings = 10)
    {
        self::$conn = self::CreateConnection();
        self::$script = self::CreateDatabase();
        self::$script .= self::PopulateDatabase($nTvShows, $nShowings);

        if ($printScript) {
            echo '<div style="font-size:0.7em;font-color:lightgray">' . self::$script . '</div>';
        }
    }
    /**
     * Retreives TV Grid from Database and returns an array with all TVSeriesInterval Objects
     *
     * @return TVSeriesIntervals[]
     */
    public static function getGrid()
    {
        $conn = self::$conn;

        $sql = "Select id,title, channel,gender,weekday,show_time from exadsTechTest.tv_series as TVS 
                inner join exadstechtest.tv_series_intervals as TVSI on TVSI.id_tv_series = TVS.id 
                order by TVS.id,weekday,show_time";
        $result = $conn->query($sql);

        $airTimes = array();
        $tvSeriesFactory = new TVSeriesFactory();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (!isset($tvShow) || $tvShow->getId() != $row["id"]) {
                    $tvShow = $tvSeriesFactory->create($row["id"], $row["title"], $row["channel"], $row["gender"]);
                }
                $tvShowInterval = new TVSeriesIntervals($tvShow, $row["weekday"], $row["show_time"]);

                array_push($airTimes, $tvShowInterval);
            }
        }

        return $airTimes;
    }
}
