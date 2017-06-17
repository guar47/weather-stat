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

        return $this->render('stat', [
            'weatherData' => $weatherData
        ]);
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
}
