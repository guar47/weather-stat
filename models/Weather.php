<?php

namespace app\models;
use yii\db\ActiveRecord;

class Weather extends ActiveRecord
{
    protected $id;
    protected $date;
    protected $hour;
    protected $temp;
    protected $city;
}