<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacies".
 *
 * @property int $id
 * @property string|null $city
 * @property string|null $state
 * @property int|null $index
 * @property string|null $street
 * @property string|null $home
 * @property string|null $flat
 * @property string|null $corpus
 * @property string|null $stroenie
 * @property string $name
 *
 * @property DrugsSku[] $drugSkus
 * @property DrugsCounts[] $drugsCounts
 */
class Pharmacies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['index'], 'integer'],
            [['name'], 'required'],
            [['city', 'state', 'street', 'name'], 'string', 'max' => 255],
            [['home', 'flat'], 'string', 'max' => 6],
            [['corpus', 'stroenie'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'state' => 'State',
            'index' => 'Index',
            'street' => 'Street',
            'home' => 'Home',
            'flat' => 'Flat',
            'corpus' => 'Corpus',
            'stroenie' => 'Stroenie',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[DrugSkus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugSkus()
    {
        return $this->hasMany(DrugsSku::class, ['id' => 'drug_sku_id'])->viaTable('drugs_counts', ['pharma_id' => 'id']);
    }

    /**
     * Gets query for [[DrugsCounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrugsCounts()
    {
        return $this->hasMany(DrugsCounts::class, ['pharma_id' => 'id']);
    }
}
