<?php

namespace app\models;

use app\models\forms\ReleaseForms;

/**
 * This is the model class for table "drugs_sku".
 * Хранит SKU
 *
 * @property int|null $count
 * @property int $drug_id
 * @property int $dosage_id
 * @property int $form_id
 * @property int|null $price
 * @property int $id
 *
 * @property Dosages $dosage
 * @property Drugs $drug
 * @property DrugsCounts[] $drugsCounts
 * @property ReleaseForms $form
 * @property Pharmacies[] $pharmas
 */
class DrugsSku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drugs_sku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'drug_id', 'dosage_id', 'form_id', 'price'], 'integer'],
            [['drug_id', 'dosage_id', 'form_id'], 'required'],
            [['dosage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosages::class, 'targetAttribute' => ['dosage_id' => 'id']],
            [['drug_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drugs::class, 'targetAttribute' => ['drug_id' => 'id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReleaseForms::class, 'targetAttribute' => ['form_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'count' => 'Количество',
            'drug_id' => 'ID Препарата',
            'dosage_id' => 'ID Дозировк',
            'form_id' => 'ID Форма упаковки',
            'price' => 'Цена',
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[Dosage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosage()
    {
        return $this->hasOne(Dosages::class, ['id' => 'dosage_id']);
    }

    /**
     * Gets query for [[Drug]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrug()
    {
        return $this->hasOne(Drugs::class, ['id' => 'drug_id']);
    }

    /**
     * Gets query for [[DrugsCounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsCounts()
    {
        return $this->hasMany(DrugsCounts::class, ['drug_sku_id' => 'id']);
    }

    /**
     * Gets query for [[DrugsCounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharma()
    {
        return $this->hasOne(Pharmacies::class, ['id' => 'pharma_id'])->via('drugsCounts');
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(ReleaseForms::class, ['id' => 'form_id']);
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getindicators()
    {
        return $this->hasMany(Indicators::class, ['id' => 'drug_id'])
            ->viaTable('drugs_indicators', ['indicator_id' => 'id']);
    }

}
