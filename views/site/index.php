<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $listDataProvider */

$this->title = 'Аптека';

?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Аптека!</h1>
    </div>

            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $listDataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'row',
                    'id' => false
                ],

                'itemView' => '_list',

                'layout' => "{items}\n{pager}",
                ]);
            ?>
        </div>
    </div>
</div>