<?php

/** @var yii\web\View $this */

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
                //'layout' => "{pager}\n<div class='container'><div class='row'><div class='col-md-4'>{items}</div></div></div>\n{summary}",

                'layout' => "{items}\n{pager}",

                ]);
            ?>
        </div>
    </div>
</div>