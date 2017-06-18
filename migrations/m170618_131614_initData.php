<?php

use yii\db\Migration;
use app\models\Weather;

class m170618_131614_initData extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        for ($month = 1; $month <= 12; $month += 1) {
            $weatherData = $this->temperatureMoscowGenerator($month);

            foreach ($weatherData as $day => $temp) {
                $weather = new Weather();
                $weather->date = date('Y-m-d', strtotime($day . '-' . $month . '-2016'));
                $weather->hour = 00;
                $weather->temp = $temp;
                $weather->city = 'Moscow';
                $weather->save();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        Weather::deleteAll();

        return true;
    }

    /**
     * @param string $month
     * @return array
     */
    private function temperatureMoscowGenerator(string $month)
    {
        $tempsMonth = [];

        switch ($month) {
            case 1:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-10, -5);
                }
                break;
            case 2:
                for ($i = 1; $i <= 28; $i += 1) {
                    $tempsMonth[$i] = rand(-8, -3);
                }
                break;
            case 3:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-3, 3);
                }
                break;
            case 4:
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(3, 11);
                }
                break;
            case 5:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(9, 20);
                }
                break;
            case 6:
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(13, 23);
                }
                break;
            case 7:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(15, 26);
                }
                break;
            case 8:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(14, 24);
                }
                break;
            case 9:
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(9, 17);
                }
                break;
            case 10:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(4, 9);
                }
                break;
            case 11:
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(0, 3);
                }
                break;
            case 12:
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-5, -2);
                }
                break;
        }

        return $tempsMonth;
    }
}
