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
            <th></th>
            <th></th>
            <th>Январь</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Неделя</th>
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
        foreach ($weatherData as $weatherDay) {
            $tableRow = '<td>' . date('d M', strtotime($weatherDay['date']))
                . ' (' . $weatherDay['temp'] . ')' . '</td>';
            $tableEmpty = '<td>' . '</td>';
            $tableWeekNumber = '<td>' . $weatherDay['week_number'] . '</td>';

            if (date('d', strtotime($weatherDay['date'])) === '01') {
                switch ($weatherDay['week_day']) {
                    case '0':
                        echo $tableRow . '</tr>' . '<tr>';
                        break;
                    case '1':
                        echo $tableEmpty . $tableRow;
                        break;
                    case '2':
                        echo $tableEmpty . $tableEmpty . $tableRow;
                        break;
                    case '3':
                        echo $tableEmpty . $tableEmpty . $tableEmpty . $tableRow;
                        break;
                    case '4':
                        echo $tableEmpty . $tableEmpty . $tableEmpty .
                            $tableEmpty . $tableRow;
                        break;
                    case '5':
                        echo $tableEmpty . $tableEmpty . $tableEmpty .
                            $tableEmpty . $tableEmpty . $tableRow;
                        break;
                    case '6':
                        echo $tableEmpty . $tableEmpty . $tableEmpty .
                            $tableEmpty . $tableEmpty . $tableEmpty . $tableRow;
                        break;
                }
            } else {
                if ($weatherDay['week_day'] === '0') {
                    echo $tableRow . '</tr>' . '<tr>';
                } elseif ($weatherDay['week_day'] === '1') {
                    echo $tableWeekNumber . $tableRow;
                } else {
                    echo $tableRow;
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>