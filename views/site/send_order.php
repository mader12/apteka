<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Заказ оформлен</h1>
    <p>
        <a type="button" class="btn btn-primary" href="/reports/make/index">Отчет о выполненных заказах</a>
        <a type="button" class="btn btn-primary" href="/reports/make/drugs">отчет о наличии лекарств в аптеках</a>
        <a type="button" class="btn btn-primary" href="/reports/make/paragraf">отчет о наличии лекарств в аптеках(абзац)</a>
    </p>
    </div>
