<?php

/** @var yii\web\View $this */

$this->title = 'Аптека';

?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Аптека!</h1>
    </div>

    <div class="body-content">
        <div class="container">
        <?php foreach ($drugs as $key => $drug) : ?>

            <?php if ($key % 3 == 0) : ?>
                </div>
            <?php endif;?>
            <?php if ($key == 0 || $key % 3 == 0) : ?>
                <div class="row">
            <?php endif;?>
                <div class="col-md-3 px-2">
                <h3><?= $drug->drug->trade_name ?></h3>
                    <button type="button" class="btn btn-outline-secondary" data="<?=$drug->id?>" onclick="send(<?=$drug->id?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        <span class="visually-hidden">Button</span>
                    </button>
                    <div>Остаток в аптеке - <?= $drug->count?></div>
                    <div>Дозировка - <?= $drug->dosage->count?> <?= $drug->dosage->name?></div>
                    <div>Форма выпуска - <?= $drug->form->name?></div>
                    <div>Показания к применению -

                        <?php foreach($drug->pharma as $pharma): ?>

                            <div>Продавец - <?= $pharma->name ?> </div>

                        <?php endforeach;?>

                        <?php if (!empty($drug->indicators)): ?>
                        <?php foreach($drug->indicators as $indicator): ?>

                            <div><?= $indicator->value ?> </div>

                        <?php endforeach;?>
                        <?php else: ?>
                        Нет показаний
                        <?php endif; ?>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>