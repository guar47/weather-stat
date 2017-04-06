<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use app\models\Weather;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, 1, 2016);
        $index_array = [];

        for ($i = 1; $i <= $days_in_month; $i++) {
            $day_array = [];

            $date = "2016-01-$i";
            $weather_table_day = Weather::find()->where(['date' => $date])->all();

            $average_night = $this->get_average_by_time($weather_table_day, 0, 5);
            $average_day = $this->get_average_by_time($weather_table_day, 6, 23);
            $week_day = date('w', strtotime($date));
            $week_number = date('W', strtotime($date));

            $day_array['date'] = $date;
            $day_array['day_temp'] = $average_day;
            $day_array['night_temp'] = $average_night;
            $day_array['week_day'] = $week_day;
            $day_array['week_number'] = $week_number;

            array_push($index_array, $day_array);
        }

        return $this->render('index', [
            'weather' => $index_array
        ]);
    }

    public function actionDatabase()
    {
        $weather = self::get_data_from_api('Moscow',
            '2016-01-01', '2016-01-31',
            '1', 'json');

        self::insert_weather_to_db($weather);

        return $this->render('database');
    }

//    FIXME: function can get $start_hour only > 0
//    FIXME: function can get $end_hour only > $start_hour
    private function get_average_by_time($day_temp_object, $start_hour, $end_hour)
    {
        $hour_count = $end_hour - $start_hour + 1;
        return round(array_reduce($day_temp_object, function ($average, $hour_temp) use ($start_hour, $end_hour) {
                if ($hour_temp->hour >= $start_hour && $hour_temp->hour <= $end_hour) {
                    return $average + $hour_temp->temp;
                }
                return $average;
            }, 0) / $hour_count);
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

        foreach ($weather['weather'] as $daily_weather) {
            $date = $daily_weather['date'];

            foreach ($daily_weather['hourly'] as $hourly_weather) {
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
    }

}