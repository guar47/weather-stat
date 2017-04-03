<?php
use yii\helpers\Html;
?>
    <h1>Weather</h1>
        <table>
        <?php foreach ($temperatures as $temp): ?>
                <tr>
                    <td>
                <?= Html::encode("{$temp->date_time}") ?>:
                    </td>
                    <td>
                <?= Html::encode("{$temp->temperature}") ?>:
                    </td>
                </tr>
        <?php endforeach; ?>
        </table>
