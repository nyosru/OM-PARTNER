<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "specification_groups_to_categories".
 *
 * @property string $specification_group_id
 * @property string $categories_id
 *
 * @property SpecificationGroups $specificationGroup
 * @property PartnersCategories $categories
 */
class SpecificationGroupsToCategories extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specification_groups_to_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specification_group_id', 'categories_id'], 'required'],
            [['specification_group_id', 'categories_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specification_group_id' => 'Specification Group ID',
            'categories_id' => 'Categories ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificationGroup()
    {
        return $this->hasOne(SpecificationGroups::className(), ['specification_group_id' => 'specification_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(PartnersCategories::className(), ['categories_id' => 'categories_id']);
    }
}
