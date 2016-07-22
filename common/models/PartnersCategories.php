<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $categories_id
 * @property string $categories_image
 * @property integer $parent_id
 * @property integer $sort_order
 * @property string $date_added
 * @property string $last_modified
 * @property integer $categories_status
 * @property integer $default_manufacturers
 * @property double $markup
 * @property string $xml_flag
 * @property string $sclad_cat
 * @property string $zpcoef_cat
 * @property string $weight
 * @property string $capacity
 */
class PartnersCategories extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_order', 'categories_status', 'default_manufacturers', 'sclad_cat'], 'integer'],
            [['date_added', 'last_modified'], 'safe'],
            [['markup', 'zpcoef_cat', 'weight', 'capacity'], 'number'],
            [['xml_flag'], 'string'],
            [['categories_image'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categories_id' => 'Categories ID',
            'categories_image' => 'Categories Image',
            'parent_id' => 'Parent ID',
            'sort_order' => 'Sort Order',
            'date_added' => 'Date Added',
            'last_modified' => 'Last Modified',
            'categories_status' => 'Categories Status',
            'default_manufacturers' => 'Default Manufacturers',
            'markup' => 'Markup',
            'xml_flag' => 'Xml Flag',
            'sclad_cat' => 'Sclad Cat',
            'zpcoef_cat' => 'Zpcoef Cat',
            'weight' => 'Weight',
            'capacity' => 'Capacity',
        ];
    }

    public function getCategoriesDescription()
    {
        return $this->hasOne(PartnersCatDescription::className(), ['categories_id' => 'categories_id']);
    }

}
