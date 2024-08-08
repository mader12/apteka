<?php

namespace app\models\orders;

use app\models\Dosages;
use app\models\Drugs;
use app\models\DrugsSku;
use app\models\forms\ReleaseForms;
use app\models\Pharmacies;
use app\models\Users;

/**
 * This is the model class for table "basket_orders".
 * хранит корзины заказов
 *
 * @property int $pharma_id
 * @property int $order_id
 * @property int $drugs_sku_id
 * @property int $id
 *
 * @property DrugsSku $drugsSku
 * @property Orders $order
 * @property Pharmacies $pharma
 */
class BasketOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pharma_id', 'order_id', 'drugs_sku_id'], 'required'],
            [['pharma_id', 'order_id', 'drugs_sku_id'], 'required'],
            [['pharma_id', 'order_id', 'drugs_sku_id'], 'integer'],
            [['drugs_sku_id'], 'exist', 'skipOnError' => true, 'targetClass' => DrugsSku::class, 'targetAttribute' => ['drugs_sku_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'id']],
            [['pharma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pharmacies::class, 'targetAttribute' => ['pharma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pharma_id' => 'Pharma ID',
            'order_id' => 'Order ID',
            'drugs_sku_id' => 'Drugs Sku ID',
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[DrugsSku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsSku()
    {
        return $this->hasOne(DrugsSku::class, ['id' => 'drugs_sku_id']);
    }

    /**
     * Gets query for [[form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(ReleaseForms::class, ['id' => 'form_id'])
            ->viaTable('drugs_sku', ['id' => 'drugs_sku_id']);
    }

    /**
     * Gets query for [[form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosage()
    {
        return $this->hasOne(Dosages::class, ['id' => 'dosage_id'])
            ->viaTable('drugs_sku', ['id' => 'drugs_sku_id']);
    }

    /**
     * Gets query for [[form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrug()
    {
        return $this->hasOne(Drugs::class, ['id' => 'drug_id'])
            ->viaTable('drugs_sku', ['id' => 'drugs_sku_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSend()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id'])->where(['send' => Orders::SEND]);
    }

    /**
     * Gets query for [[form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserSend()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id'])
            ->viaTable('orders', ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Pharma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharma()
    {
        return $this->hasOne(Pharmacies::class, ['id' => 'pharma_id']);
    }
}
