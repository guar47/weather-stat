<?php

use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Weather statistics database';

?>
<div class="site-index">
    <br>
    <?= yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => '<b>Success</b>, Data obtained from the API and added to the database'
    ]); ?>
</div>