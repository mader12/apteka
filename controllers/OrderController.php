<?php

namespace app\controllers;

use app\models\orders\BasketOrder;
use app\models\orders\Orders;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('У вас нет доступа к этой странице');
                },
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $post = Yii::$app->request->post();
        $order = new Orders;
        $order->user_id = \Yii::$app->user->id;
        $order->send = Orders::SEND;
        $order->save();

        foreach ($post as $drugs) {
            $basket = new BasketOrder();
            $basket->order_id = $order->id;
            $basket->pharma_id = $drugs->pharma_id;
            $basket->drugs_sku_id = $drugs->id;
            $basket->save();
        }

        return true;
    }
}