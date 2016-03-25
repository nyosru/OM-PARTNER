<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use yii;
use yii\base\InvalidCallException;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "specifications".
 *
 * @property string $specifications_id
 * @property string $specification_group_id
 * @property integer $specification_sort_order
 * @property string $show_comparison
 * @property string $show_products
 * @property string $show_filter
 * @property string $products_column_name
 * @property string $column_justify
 * @property string $filter_class
 * @property string $filter_display
 * @property string $filter_show_all
 * @property string $enter_values
 *
 * @property SpecificationDescription $specificationDescription
 * @property SpecificationDescription[] $specificationDescriptions
 * @property SpecificationGroups $specificationGroup
 * @property SpecificationValues $specificationValues
 */
class Specifications extends ActiveRecordExt
{

    public static function tableName()
    {
        return 'specifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specification_group_id', 'specification_sort_order','specifications_id'], 'integer'],
            [['show_comparison', 'show_products', 'show_filter', 'column_justify', 'filter_class', 'filter_display', 'filter_show_all', 'enter_values'], 'string'],
            [['products_column_name'], 'required'],
            [['products_column_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specifications_id' => 'Specifications ID',
            'specification_group_id' => 'Specification Group ID',
            'specification_sort_order' => 'Specification Sort Order',
            'show_comparison' => 'Show Comparison',
            'show_products' => 'Show Products',
            'show_filter' => 'Show Filter',
            'products_column_name' => 'Products Column Name',
            'column_justify' => 'Column Justify',
            'filter_class' => 'Filter Class',
            'filter_display' => 'Filter Display',
            'filter_show_all' => 'Filter Show All',
            'enter_values' => 'Enter Values',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationDescriptions()
    {
        return $this->hasMany(SpecificationDescription::className(), ['specifications_id' => 'specifications_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationDescription()
    {
        return $this->hasOne(SpecificationDescription::className(), ['specifications_id' => 'specifications_id'])->andOnCondition(['language_id' => $this->defaultLanguageID]);
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationGroup()
    {
        return $this->hasOne(SpecificationGroups::className(), ['specification_group_id' => 'specification_group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(PartnersCategories::className(), ['categories_id' => 'categories_id'])->via('specificationGroupsToCategories');
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationGroupsToCategories()
    {
        return $this->hasMany(SpecificationGroupsToCategories::className(), ['specification_group_id' => 'specification_group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationValues()
    {
        return $this->hasOne(SpecificationValues::className(), ['specifications_id' => 'specifications_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecificationValuesDescription()
    {
        return $this->hasMany(SpecificationValuesDescription::className(), ['specification_values_id' => 'specification_values_id'])->via('values');
    }

    /**
     * Прихреначит эту спецификацию к категории
     * @param PartnersCategories $category
     */
    public function attachToCategory(PartnersCategories $category)
    {
        $alreadyIn = $this->getCategories()->where(['categories_id' => $category->categories_id])->one();

        if (!$alreadyIn){
            $this->link('categories', $category);
        }
    }

    /**
     * @return ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(SpecificationValues::className(), ['specifications_id' => 'specifications_id']);
    }

    /**
     * @param $name
     * @return ActiveQuery
     */
    public static function findByName($name)
    {
        $spec = self::find()
            ->innerJoinWith('specificationDescription')
            ->where([
                'specification_name' => $name
            ]);

        return $spec;
    }



    public function extraFields(){

        return [
            'specificationDescription'
        ];
    }
}
