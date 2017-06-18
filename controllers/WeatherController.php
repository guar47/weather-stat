<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use app\models\Weather;

class WeatherController extends Controller
{
    public function actionStat()
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, 1, 2016);
        $weatherData = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dayWeather = [];

            $date = "2016-01-$i";
            $weatherDayRecord = Weather::find()->where(['date' => $date])->one();

            $weekDay = date('w', strtotime($date));
            $weekNumber = date('W', strtotime($date));

            $dayArray['date'] = $date;
            $dayArray['temp'] = $weatherDayRecord->temp;
            $dayArray['week_day'] = $weekDay;
            $dayArray['week_number'] = $weekNumber;

            array_push($weatherData, $dayArray);
        }

        return $this->render('stat', [
            'weatherData' => $weatherData
        ]);
    }
}
