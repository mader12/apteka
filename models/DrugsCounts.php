<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drugs_counts".
 *
 * @property int $drug_sku_id
 * @property int $pharma_id
 *
 * @property DrugsSku $drugSku
 * @property Pharmacies $pharma
 */
class DrugsCounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drugs_counts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drug_sku_id', 'pharma_id'], 'required'],
            [['drug_sku_id', 'pharma_id'], 'integer'],
            [['drug_sku_id', 'pharma_id'], 'unique', 'targetAttribute' => ['drug_sku_id', 'pharma_id']],
            [['drug_sku_id'], 'exist', 'skipOnError' => true, 'targetClass' => DrugsSku::class, 'targetAttribute' => ['drug_sku_id' => 'id']],
            [['pharma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pharmacies::class, 'targetAttribute' => ['pharma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'drug_sku_id' => 'Drug Sku ID',
            'pharma_id' => 'Pharma ID',
        ];
    }

    /**
     * Gets query for [[DrugSku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugSku()
    {
        return $this->hasOne(DrugsSku::class, ['id' => 'drug_sku_id']);
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
