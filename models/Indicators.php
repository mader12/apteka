<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indicators".
 *
 * @property int $id
 * @property string|null $value
 *
 * @property DrugsIndicators[] $drugsIndicators
 * @property Drugs[] $pharmaceuticals
 */
class Indicators extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[DrugsIndicators]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsIndicators()
    {
        return $this->hasMany(DrugsIndicators::class, ['indicator_id' => 'id']);
    }

    /**
     * Gets query for [[Pharmaceuticals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharmaceuticals()
    {
        return $this->hasMany(Drugs::class, ['id' => 'pharmaceutical_id'])->viaTable('drugs_indicators', ['indicator_id' => 'id']);
    }
}
