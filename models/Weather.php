<?php

namespace app\models;
use yii\db\ActiveRecord;

/*
 * @property int $id
 * @property date $date
 * @property int $hour
 * @property int $temp
 * @property varchar $city
 */

class Weather extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'weather';
    }
}