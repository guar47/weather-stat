<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use app\models\Weather;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, 1, 2016);
        $weatherData = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dayArray = [];

            $date = "2016-01-$i";
            $weatherTableDay = Weather::find()->where(['date' => $date])->all();

            $averageNight = $this->getAverageByTime($weatherTableDay, 0, 5);
            $averageDay = $this->getAverageByTime($weatherTableDay, 6, 23);
            $weekDay = date('w', strtotime($date));
            $weekNumber = date('W', strtotime($date));

            $dayArray['date'] = $date;
            $dayArray['day_temp'] = $averageDay;
            $dayArray['night_temp'] = $averageNight;
            $dayArray['week_day'] = $weekDay;
            $dayArray['week_number'] = $weekNumber;

            array_push($indexArray, $dayArray);
        }

        return $this->render('index', [
            'weatherData' => $weatherData
        ]);
    }

    public function actionDatabase()
    {
        $weather = self::getDataFromApi('Moscow',
            '2016-01-01', '2016-01-31',
            '1', 'json');

        self::insertWeatherToDB($weather);

        return $this->render('database');
    }

//    FIXME: function can get $startHour only > 0
//    FIXME: function can get $endHour only > $startHour
    private function getAverageByTime($dayTempObject, $startHour, $endHour)
    {
        $hourCount = $endHour - $startHour + 1;
        return round(array_reduce($dayTempObject, function ($average, $hourTemp) use ($startHour, $endHour) {
                if ($hourTemp->hour >= $startHour && $hourTemp->hour <= $endHour) {
                    return $average + $hourTemp->temp;
                }
                return $average;
            }, 0) / $hourCount);
    }

    private function getDataFromApi($city, $startDate, $endDate, $timeInterval, $format)
    {
        $client = new Client();

        return $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://api.worldweatheronline.com/premium/v1/past-weather.ashx')
            ->setData([
                'key' => 'e3ce250a888b400e83c110545170204',
                'q' => $city,
                'date' => $startDate,
                'enddate' => $endDate,
                'tp' => $timeInterval,
                'format' => $format
            ])
            ->send()->data['data'];
    }

    private function insertWeatherToDB($weather)
    {
        $requestCity = $weather['request']['0']['query'];

        foreach ($weather['weather'] as $dailyWeather) {
            $date = $dailyWeather['date'];

            foreach ($dailyWeather['hourly'] as $hourlyWeather) {
                $weatherTable = new Weather();
                $hour = $hourlyWeather['time'] !== '0' ? substr($hourlyWeather['time'], 0, -2) : '0';
                $temperature = $hourlyWeather['tempC'];

                $weatherTable->date = $date;
                $weatherTable->hour = $hour;
                $weatherTable->temp = $temperature;
                $weatherTable->city = $requestCity;
                $weatherTable->save();
            }
        }
    }

}