<?php

namespace app\modules\reports\controllers;

use app\models\DrugsSku;
use app\models\orders\BasketOrder;
use app\modules\reports\helpers\Excel;
use app\modules\reports\helpers\Word;
use yii\web\Controller;

/**
 * Default controller for the `reports` module
 */
class MakeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $basket = BasketOrder::find()
            ->with('drugsSku')
            ->innerJoinWith('orderSend')
            ->with('form')
            ->with('drug')
            ->with('pharma')
            ->with('userSend')
            ->all()
        ;
        $orders = [];

        foreach ($basket as $order) {
            $orders[$order->orderSend->id][] = $order;
        }
        Excel::makeReportOrders($orders);

        return $this->goBack();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionDrugs()
    {
        $drugs = DrugsSku::find()
            ->with('drug')
            ->with('dosage')
            ->with('form')
            ->with('pharma')
            ->with('indicators')->all();

        $drugs_up = [];
        foreach ($drugs as $drug) {
            $drugs_up[$drug->drug_id][$drug->form_id][$drug->dosage_id][] = $drug;
        }

        Word::makeReportCount($drugs_up);

        return $this->goBack();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionParagraf()
    {
        $drugs = DrugsSku::find()
            ->with('drug')
            ->with('dosage')
            ->with('form')
            ->with('pharma')
            ->with('indicators')->all();

        $drugs_up = [];
        foreach ($drugs as $drug) {
            $drugs_up[$drug->drug_id][$drug->form_id][$drug->dosage_id][] = $drug;
        }

        Word::makeReportCountParagraf($drugs_up);

        return $this->goBack();
    }
}
