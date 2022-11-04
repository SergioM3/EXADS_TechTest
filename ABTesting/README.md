<p align="center"><img src="https://www.exads.com/images/brand/card.png" width="200" alt="EXADS Logo"></p>


## 4. AB Testing

Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
tv_series -> (id, title, channel, gender);
tv_series_intervals -> (id_tv_series, week_day, show_time);
(Provide the SQL scripts that create and populate the DB;)

Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
inputted time-date, and that can be optionally filtered by TV Series title.

## Framework

Laravel 9

## Observations / Considerations 

- Laravel's default behaviour implies a Model / Entity, "is a table" in a database.
Considering this exercise did not require the usage of a database, it was not used and a Model is treated as a "regular class".<br><br>
- Pattern used was MVC, but with no views only an API.


## API Routes : 

- <b>/promotions/{promoId}/designs</b> 
    Returns all designs from a promotion based on {promoId}
    <br>
- <b>/designs/{promoId}/{designId}</b>
    Returns specific design of a specific promotion based on {promoId} and {designId}