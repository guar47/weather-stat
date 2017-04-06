<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use app\models\Weather;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $weather = self::get_data_from_api('Moscow',
            '2016-01-01', '2016-01-01',
            '1', 'json');

        self::insert_weather_to_db($weather);

        return $this->render('index');
    }

    public function actionDatabase()
    {
        $weather_table = Weather::find()->all();

        return $this->render('database', [
                'weather_table' => $weather_table,
        ]);
    }

    private function get_data_from_api($city, $start_date, $end_date, $time_interval, $format)
    {
        $client = new Client();

        return $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://api.worldweatheronline.com/premium/v1/past-weather.ashx')
            ->setData([
                'key' => 'e3ce250a888b400e83c110545170204',
                'q' => $city,
                'date' => $start_date,
                'enddate' => $end_date,
                'tp' => $time_interval,
                'format' => $format
            ])
            ->send()->data['data'];
    }

    private function insert_weather_to_db($weather)
    {
        $request_city = $weather['request']['0']['query'];

        foreach ($weather['weather'] as $daily_weather)
        {
            $date = $daily_weather['date'];

            foreach ($daily_weather['hourly'] as $hourly_weather)
            {
                $weather_table = new Weather();
                $hour = $hourly_weather['time'] !== '0' ? substr($hourly_weather['time'], 0, -2) : '0';
                $temperature = $hourly_weather['tempC'];

                $weather_table->date = $date;
                $weather_table->hour = $hour;
                $weather_table->temp = $temperature;
                $weather_table->city = $request_city;
                $weather_table->save();
            }
        }
        echo '<br>';
        echo '<br>';
        echo '<br>';
    }

}