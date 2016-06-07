<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "specification_values".
 *
 * @property string $specification_values_id
 * @property string $specifications_id
 * @property integer $value_sort_order
 *
 * @property ProductsSpecifications[] $productsSpecifications
 * @property SpecificationValuesDescription $specificationValuesDescription
 */
class SpecificationValues extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specification_values';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specifications_id', 'value_sort_order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specification_values_id' => 'Specification Values ID',
            'specifications_id' => 'Specifications ID',
            'value_sort_order' => 'Value Sort Order',
        ];
    }


    public function getProductsSpecifications()
    {
        return $this->hasMany(ProductsSpecifications::className(), ['specification_values_id' => 'specification_values_id']);
    }

    public function getSpecificationValuesDescription()
    {
        return $this->hasOne(SpecificationValuesDescription::className(), ['specification_values_id' => 'specification_values_id']);
    }

    public function getDescription()
    {
        return $this->getSpecificationValuesDescription();
    }

    public function extraFields()
    {

        return [
            'specificationValuesDescription'
        ];
    }
}
