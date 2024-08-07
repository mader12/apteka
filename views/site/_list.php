<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
/** @var yii\web\View $model */

?>
<div class="post class-md-4" >
    <h2><?= Html::encode($model->drug->trade_name) ?></h2>

<?php
    echo 'Количество в аптеке ' . Html::encode($model->count) . '</br>';
    echo 'Цена: ' . Html::encode($model->price) . '</br>';
    echo 'Дозировка: ' . Html::encode($model->dosage->count . ' ' . $model->dosage->name)  . '</br>';
    echo 'Форма выпуска: ' . Html::encode($model->form->name) . '</br>';
    echo 'Количество в аптеках: ' . Html::encode($model->count) . '</br>';
    echo 'Аптека: ' . Html::encode($model->pharma->name) . '
    <button type="button" class="btn btn-outline-secondary" 
        data-id="' . $model->id . '" data-name="' . $model->pharma->id . '" onclick="send(' . $model->pharma->id . ','.$model->id.')">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"></path>
        </svg>
        <span class="visually">Купить в этой аптеке</span>
    </button></br>  ';
    if (is_array($model->indicators)) {
        foreach ($model->indicators as $indicator) {
            $indicators .= $indicator->value . ' ';
        }
    } else {
        $indicators = 'Нет описания';
    }

    echo 'Описание ' . Html::encode($indicators);
?>
</div>
