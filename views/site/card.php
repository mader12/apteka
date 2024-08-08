<?php

/** @var yii\web\View $drug */

$this->title = $drug->drug->trade_name;

?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h2 ><?= $this->title?></h2>
    </div>
     <div>
         Дозировка - <?= $drug->dosage->count ?> <?= $drug->dosage->name ?> <br />
         Количество - <?= $drug->count ?>шт.<br />
         Продавец - <?= $drug->pharma->name ?><br />
         Форма выпуска: <?= $drug->form->name ?></br>

         <?php
         if (is_array($drug->indicators)) {
             foreach ($drug->indicators as $indicator) {
                 $indicators .= $indicator->value . ' ';
             }
         } else {
             $indicators = 'Нет описания';
         }
         ?>
         Описание <?= $indicators?>
     </div>
</div>