<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

function d($var) {
    echo '<pre style="padding:20px; margin:20px; color:#1e7e34; background-color: #000000;">';
    var_Dump($var);
    echo '</pre>';
    exit();
}

function v($var) {
    echo '<pre style="padding:20px; margin:20px; color:#1e7e34; background-color: #000000;">';
    var_Dump($var);
    echo '</pre>';
}