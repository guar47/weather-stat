<?php

use yii\jui\DatePicker;

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
        'value'  => '2016-02-01',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>
</div>