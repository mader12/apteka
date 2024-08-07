<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>
    <?=
    \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'row',
            'id' => false
        ],

        'itemView' => '_list_basket',

        'layout' => "{items}\n{pager}",

    ]);
    ?>
    <a type="button" class="btn btn-primary" href="/order/index">купить</a>
    <br />
    <br />
    <br />
    <a type="button" class="btn btn-primary" href="/reports/make/index">Отчет о выполненных заказах</a>
    <a type="button" class="btn btn-primary" href="/reports/make/drugs">отчет о наличии лекарств в аптеках</a>
    <a type="button" class="btn btn-primary" href="/reports/make/paragraf">отчет о наличии лекарств в аптеках(абзац)</a>
</div>
