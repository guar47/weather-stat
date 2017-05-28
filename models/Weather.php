<?php

namespace app\models;
use yii\db\ActiveRecord;

class Weather extends ActiveRecord
{
    const MOSCOW_LATITUDE = 55.753492;
    const MOSCOW_LONGITUDE = 37.620479;

    public static function tableName()
    {
        return 'weather';
    }
}