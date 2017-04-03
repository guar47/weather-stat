<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\WeatherMoscow;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $temperatures = WeatherMoscow::find()->all();

        return $this->render('index', [
            'temperatures' => $temperatures,
        ]);
    }
}