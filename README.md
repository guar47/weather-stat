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