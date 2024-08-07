<?php

namespace app\controllers;

use app\models\BasketOrder;
use app\models\DrugsSku;
use app\models\Order;
use app\models\Orders;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AjaxFilter;

class ApiController  extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return  [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['save-anonim-basket'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['save-anonim-basket'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['save-anonim-basket'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'save-anonim-basket'  => ['post'],
              ]
            ]
        ];
    }

    /**
     * @return string save-anonim-basket
     */
    public function actionSaveAnonimBasket()  : string
    {
        $request = \Yii::$app->request->post();

        $drugs = DrugsSku::find()->where('id=:id', [':id' => $request['id']])
            ->with('drug')
            ->with('dosage')
            ->with('form')
            ->with('pharma')
            ->with('indicators')->one();

        $basket = BasketOrder::find()->where(['session_id' => Yii::$app->session->getId()])->one();
        $basketNew = new BasketOrder();

        if (empty($basket)) {
            $order = new Orders();

            if (Yii::$app->user->isGuest) {
                $order->user_id = Users::GUEST_ID_DEFAULT;
            }

            try {
                $order->save();
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
            $basketNew->order_id = $order->id;

        } else {
            $basketNew->order_id = $basket->order_id;
        }

        $basketNew->session_id = \Yii::$app->session->getId();
        $basketNew->drugs_sku_id = $drugs->id;
        $basketNew->pharma_id = (int) $request['pharma_id'];

        try {
            $basketNew->save();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return 'true';
    }
}