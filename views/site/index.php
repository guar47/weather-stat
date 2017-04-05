<?php

use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Weather statistics';

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
        'value' => '2016-02-01',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    echo '<br>';
    echo '<br>';
    echo Html::a('add data to DB', Url::to(['weather/index'], true));
    echo '<br>';
    echo Html::a('get data from DB', Url::to(['weather/database'], true));
    ?>
</div>