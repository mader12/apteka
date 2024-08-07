<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "release_forms".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property DrugsSku[] $drugsSkus
 */
class ReleaseForms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'release_forms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        return $this->hasMany(DrugsSku::class, ['form_id' => 'id']);
    }
}
