<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drugs".
 *
 * @property int $id
 * @property string|null $trade_name
 * @property string|null $word_names Международное непатентованное наименование (МНН) 
 *
 * @property DrugsIndicators[] $drugsIndicators
 * @property DrugsSku[] $drugsSkus
 * @property Indicators[] $indicators
 */
class Drugs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drugs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trade_name', 'word_names'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trade_name' => 'Trade Name',
            'word_names' => 'Word Names',
        ];
    }

    /**
     * Gets query for [[DrugsIndicators]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsIndicators()
    {
        return $this->hasMany(DrugsIndicators::class, ['pharmaceutical_id' => 'id']);
    }

    /**
     * Gets query for [[DrugsSkus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsSkus()
    {
        return $this->hasMany(DrugsSku::class, ['drug_id' => 'id']);
    }

    /**
     * Gets query for [[Indicators]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndicators()
    {
        return $this->hasMany(Indicators::class, ['id' => 'indicator_id'])->viaTable('drugs_indicators', ['pharmaceutical_id' => 'id']);
    }
}
