<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_specifications".
 *
 * @property integer $products_specification_id
 * @property string $products_id
 * @property integer $specifications_id
 * @property integer $language_id
 * @property string $specification
 * @property string $specification_values_id
 *
 * @property Specifications $specifications
 * @property SpecificationValues $specificationValue
 * @property PartnersCategories $products
 */
class ProductsSpecifications extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_specifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'specifications_id', 'language_id', 'specification_values_id'], 'integer'],
            [['specification_values_id'], 'required'],
            [['specification'], 'string', 'max' => 255],
            [['products_id', 'specifications_id', 'language_id'], 'unique', 'targetAttribute' => ['products_id', 'specifications_id', 'language_id'], 'message' => 'The combination of Products ID, Specifications ID and Language ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_specification_id' => 'Products Specification ID',
            'products_id' => 'Products ID',
            'specifications_id' => 'Specifications ID',
            'language_id' => 'Language ID',
            'specification' => 'Specification',
            'specification_values_id' => 'Specification Values ID',
        ];
    }

    public function getSpecifications()
    {
        return $this->hasOne(Specifications::className(), ['specifications_id' => 'specifications_id']);
    }

    public function getSpecificationValue()
    {
        return $this->hasOne(SpecificationValues::className(), ['specification_values_id' => 'specification_values_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(PartnersProducts::className(), ['products_id' => 'products_id']);
    }

    public function getSpecificationDescription()
    {
        return $this->hasOne(SpecificationDescription::className(), ['specifications_id' => 'specifications_id'])->andOnCondition(['language_id' => $this->defaultLanguageID]);
    }

    public function getSpecificationValues()
    {
        return $this->hasOne(SpecificationValues::className(), ['specifications_id' => 'specifications_id']);
    }

    public function getSpecificationValuesDescription()
    {
        return $this->hasOne(SpecificationValuesDescription::className(), ['specification_values_id' => 'specification_values_id']);
    }

    public function extraFields(){

        return [
            'specificationDescription',
            'specificationValuesDescription',
        ];
    }
}
