<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosages".
 * Справочник дозировок
 * @property int $id
 * @property float|null $count
 * @property string|null $name
 *
 * @property DrugsSku[] $drugsSkus
 */
class Dosages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'number'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Count',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[DrugsSkus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsSkus()
    {
        return $this->hasMany(DrugsSku::class, ['dosage_id' => 'id']);
    }
}
