<?php

namespace app\commands;

use app\models\Weather;
use \yii\console\Controller;
use yii\httpclient\Client;


class DataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionIndex()
    {

    }

    /**
     * @param string $month
     * @return array
     */
    private function temperatureMoscowGenerator(string $month)
    {
        $tempsMonth = [];

        switch ($month) {
            case 'January':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-10, -5);
                }
                break;
            case 'February':
                for ($i = 1; $i <= 28; $i += 1) {
                    $tempsMonth[$i] = rand(-8, -3);
                }
                break;
            case 'March':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-3, 3);
                }
                break;
            case 'April':
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(3, 11);
                }
                break;
            case 'May':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(9, 20);
                }
                break;
            case 'June':
                for ($i = 1; $i <= 30; $i += 1) {
                    $tempsMonth[$i] = rand(13, 23);
                }
                break;
            case 'July':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(15, 26);
                }
                break;
            case 'August':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(14, 24);
                }
                break;
            case 'September':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(9, 17);
                }
                break;
            case 'October':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(4, 9);
                }
                break;
            case 'November':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(0, 3);
                }
                break;
            case 'December':
                for ($i = 1; $i <= 31; $i += 1) {
                    $tempsMonth[$i] = rand(-5, -2);
                }
                break;
        }

        var_dump($tempsMonth);
        return $tempsMonth;
    }
}