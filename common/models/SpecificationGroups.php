<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "specification_groups".
 *
 * @property string $specification_group_id
 * @property string $specification_group_name
 * @property string $show_comparison
 * @property string $show_products
 * @property string $show_filter
 *
 * @property SpecificationGroupsToCategories[] $specificationGroupsToCategories
 * @property PartnersCategories[] $categories
 * @property Specifications[] $specifications
 */
class SpecificationGroups extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specification_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specification_group_name'], 'required'],
            [['show_comparison', 'show_products', 'show_filter'], 'string'],
            [['specification_group_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specification_group_id' => 'Specification Group ID',
            'specification_group_name' => 'Specification Group Name',
            'show_comparison' => 'Show Comparison',
            'show_products' => 'Show Products',
            'show_filter' => 'Show Filter',
        ];
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
    public function getCategories()
    {
        return $this->hasMany(PartnersCategories::className(), ['categories_id' => 'categories_id'])->viaTable('specification_groups_to_categories', ['specification_group_id' => 'specification_group_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(Specifications::className(), ['specification_group_id' => 'specification_group_id']);
    }
}
