<?php

use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Weather statistics';
$url = 'http://localhost:63342/weather_stat/web/index.php?r=weather%2Findex';
?>
<div class="site-index">

    <?php
    echo DatePicker::widget([
//        'model' => $model,
        'attribute' => 'from_date',
        'value' => '2016-01-01',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    echo DatePicker::widget([
//        'model' => $model,
        'attribute' => 'to_date',
        'value'  => '2016-02-01',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    echo '<br>';
    echo '<br>';
    echo Html::a('get weather data', Url::to($url, true))
    ?>
</div>