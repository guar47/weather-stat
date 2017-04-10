<?php

use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Weather statistics index';

?>
<div class="site-index">
    <br>
    <table class="table">
        <thead>
        <tr>
            <!--            <th></th>-->
            <th></th>
            <th>Январь</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <!--            <th>Неделя</th>-->
            <th>ПН</th>
            <th>ВТ</th>
            <th>СР</th>
            <th>ЧТ</th>
            <th>ПТ</th>
            <th>СБ</th>
            <th>ВС</th>
        </tr>
        </thead>
        <tbody>
        <?php

        echo '<tr>';
        foreach ($weather as $weather_day) {
            $table_row = '<td>' . date('d M', strtotime($weather_day['date'])) . '(' . $weather_day['day_temp'] .
                ' / ' . $weather_day['night_temp'] . ')' . '</td>';
            $table_empty = '<td>' . '</td>';
            if (date('d', strtotime($weather_day['date'])) === '01') {
                switch ($weather_day['week_day']) {
                    case '0':
                        echo $table_row . '</tr>' . '<tr>';
                        break;
                    case '1':
                        echo $table_row;
                        break;
                    case '2':
                        echo $table_empty . $table_row;
                        break;
                    case '3':
                        echo $table_empty . $table_empty . $table_row;
                        break;
                    case '4':
                        echo $table_empty . $table_empty .
                            $table_empty . $table_row;
                        break;
                    case '5':
                        echo $table_empty . $table_empty .
                            $table_empty . $table_empty . $table_row;
                        break;
                    case '6':
                        echo $table_empty . $table_empty .
                            $table_empty . $table_empty . $table_empty . $table_row;
                        break;
                }
            } else {
                if ($weather_day['week_day'] === '0') {
                    echo $table_row . '</tr>' . '<tr>';
                } else {
                    echo $table_row;
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>