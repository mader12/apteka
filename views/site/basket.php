<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p></p>

    <div class="container basket">
        <div class="row">

        </div>
    </div>

    <a type="button" class="btn btn-primary" id="buy" href="/order/index">
        Купить</a>
    <br />
    <br />
    <a type="button" class="btn btn-primary" href="/reports/make/index">Отчет о выполненных заказах</a>
    <a type="button" class="btn btn-primary" href="/reports/make/drugs">отчет о наличии лекарств в аптеках</a>
    <a type="button" class="btn btn-primary" href="/reports/make/paragraf">отчет о наличии лекарств в аптеках(абзац)</a>
</div>
