<p align="center"><img src="https://www.exads.com/images/brand/card.png" width="200" alt="EXADS Logo"></p>


## 3. TV Series

Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
tv_series -> (id, title, channel, gender);
tv_series_intervals -> (id_tv_series, week_day, show_time);
(Provide the SQL scripts that create and populate the DB;)

Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
inputted time-date, and that can be optionally filtered by TV Series title.

## Framework

None 

## Parameters 

PHP server should be run at ./public and index.php has the following GET Parameters available: 

- <b>viewScript</b> (default : false)
    Prints to screen the database creation and population scripts.<br><br>

- <b>viewDebugList</b> (default : false)
    Prints to screen, list of randomly generated TV Show grid, with all shows "airing" in all channels.
    (This helps to manually verify if the algorithm is returning the correct next TV Show). <br><br>
- <b>useDatabase</b> (default : true). 
    To ease the development, before adding to the database, the data was populated in an array in memory. If set to false, the program uses the memory instead of the database to randomly store tv grid.<br><br>
- <b>filterDate</b> (default : null)
    If null, the algorithm returns shows after current datetime, otherwise, it returns only shows after set date by this parameter. 
    (Only Works with format "m/d/Y H:i:s", otherwise it will have unexpected behaviour - no rule to catch that error was created)<br><br>
    
- <b>filterTVShow</b> (default : null)
    If set to anything, the algorithm will return the next show of that name, otherwise it will return any next show

## Example database creation script

<div style="font-size:0.6em">drop schema IF EXISTS exadsTechTest;<br><br>
CREATE DATABASE exadsTechTest;<br><br>
CREATE TABLE exadsTechTest.tv_series ( id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(500) NOT NULL, channel VARCHAR(100) NOT NULL, gender VARCHAR(20) );<br><br>
CREATE TABLE exadsTechTest.tv_series_intervals ( id_tv_series INT NOT NULL, weekday int NOT NULL, show_time time NOT NULL, CONSTRAINT fk_tv_series foreign key (id_tv_series) references exadsTechTest.tv_series(id) ON DELETE CASCADE );<br><br>
START TRANSACTION;
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Curb Your Enthusiasm', 'Adult Swim', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '00:58:54');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '10:36:26');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '18:53:04');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '08:18:30');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '08:00:51');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Marvel''s Daredevil', 'Comedy Central', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '21:41:43');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '20:48:08');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '04:25:40');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '11:42:35');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '19:02:17');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Death Note', 'Netflix', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '01:11:32');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '20:31:05');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '18:08:15');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '21:36:10');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '23:16:49');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Arrow', 'A&E', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '17:43:56');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '19:34:18');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '10:48:20');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '13:04:35');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '17:20:56');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('The Newsroom', 'Starz', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '09:14:49');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '09:01:51');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '03:06:11');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '23:18:45');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '14:52:36');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Curb Your Enthusiasm', 'Disney Channel', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '04:51:21');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '04:12:28');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '20:57:03');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '22:22:56');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '19:40:35');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Marvel''s The Punisher', 'AMC', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '01:22:59');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '20:09:10');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '23:19:45');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '09:40:52');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '23:24:49');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Family Guy', 'A&E', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '20:48:21');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '06:46:02');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '00:33:20');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '10:07:24');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '21:27:12');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Euphoria', 'The CW', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '07:01:41');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '10:08:01');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '23:47:27');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '05:00:15');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '13:55:33');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Family Guy', 'Comedy Central', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '04:14:48');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '01:50:42');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '07:06:22');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '00:33:13');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '09:38:09');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('American Horror Story', 'Channel4', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '08:33:38');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '04:29:40');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '21:37:45');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '11:39:23');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '18:56:46');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Marvel''s The Punisher', 'Crunchyroll', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '17:12:26');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '13:06:27');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '10:38:13');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '00:30:30');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '10:41:01');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Sense 8', 'USA Network', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '18:09:42');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '15:14:53');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '03:35:19');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '07:53:24');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '16:18:28');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Chernobyl', 'Showtime', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '15:57:43');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '10:47:54');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '13:19:10');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '02:54:25');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '14:01:42');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Bloodline', 'The CW', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '16:31:40');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '06:59:01');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '15:20:40');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '21:50:13');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '19:41:50');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Freaks and Geeks', 'Channel4', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '08:42:32');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '04:59:58');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '15:19:34');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '23:07:57');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '08:45:15');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Outlander', 'AMC', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '14:57:36');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '21:07:10');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '08:29:00');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '20:56:50');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '03:51:51');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Parks and Recreation', 'USA Network', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 2, '03:49:15');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '17:19:10');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '04:18:14');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '06:10:16');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '09:09:14');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('The Walking Dead', 'Cinemax', 'male');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 6, '22:55:15');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '23:10:04');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '13:24:35');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '03:20:55');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '17:47:16');
INSERT INTO exadsTechTest.tv_series(title, channel,gender) VALUES ('Dark', 'ARTE', 'female');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 4, '01:05:58');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 3, '08:37:31');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 5, '15:44:36');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 1, '11:12:13');
INSERT INTO exadsTechTest.tv_series_intervals(id_tv_series,weekday, show_time) VALUES (LAST_INSERT_ID(), 0, '21:03:56');
COMMIT;</div>