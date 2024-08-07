<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="post class-md-4" >
<!--    --><?php //d($model); exit; ?>
    <h2><?= Html::encode($model->drug->trade_name) ?></h2>

<?php

    echo 'Цена ' . Html::encode($model->drugsSku->price) . PHP_EOL;
    echo 'Дозировка ' . Html::encode($model->dosage->count . ' ' . $model->dosage->name)  . '</br>';
    echo 'Форма выпуска ' . Html::encode($model->dosage->name) . '</br>';
    echo 'Аптека ' . Html::encode($model->pharma->name) . '
    </br>  ';

?>
</div>
