Weather statistics
============================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

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
You must create table structure following this commands:

```mysql
CREATE TABLE weather.weather_moscow
(
    date_time DATETIME,
    daily_average_temp INT,
    nightly_average_temp INT
);
```