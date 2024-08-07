<?php

namespace app\controllers;

use app\models\BasketOrder;
use app\models\Orders;
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
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    public function actionIndex() {

        $basket = BasketOrder::find()->where(['session_id' => \Yii::$app->session->getId()])->one();
        $order = Orders::findOne(['id' => $basket->order_id]);
        $order->user_id = Yii::$app->user->identity->id;
        $order->send = Orders::SEND;
        $order->save();

        return Yii::$app->response->redirect(['site/send']); //site/send
    }
}