Weather statistics
============================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

```
git clone https://github.com/guar47/weather_stat.git
composer install
```
And after database configuration
```
php yii migrate
```

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=weather',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

OTHER COMMENTS
-------------
```
- Chosing date is not working now.
- To add data to the database from the public API, click the button "add data to DB" (on a trial basis, requested for January 2016)
- If you request the data multiple times in the database is a duplicate, but the stats will be displayed correctly as at the moment data are only for January 2016
- After add data, you can request the statistics by click "get statistics", with no data in the database the temperature will not be considered
```