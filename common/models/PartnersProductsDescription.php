<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "products_description".
 *
 * @property string $products_id
 * @property string $language_id
 * @property string $products_name
 * @property string $products_description
 * @property string $products_tab_1
 * @property string $products_tab_2
 * @property string $products_tab_3
 * @property string $products_tab_4
 * @property string $products_tab_5
 * @property string $products_tab_6
 * @property string $products_url
 * @property integer $products_viewed
 * @property string $products_head_title_tag
 * @property string $products_head_desc_tag
 * @property string $products_head_keywords_tag
 * @property string $products_info
 */
class PartnersProductsDescription extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'language_id', 'products_name'], 'required'],
            [['products_id', 'language_id', 'products_viewed'], 'integer'],
            [['products_description', 'products_tab_1', 'products_tab_2', 'products_tab_3', 'products_tab_4', 'products_tab_5', 'products_tab_6', 'products_head_desc_tag', 'products_head_keywords_tag'], 'string'],
            [['products_name', 'products_url', 'products_head_title_tag'], 'string', 'max' => 255],
            [['products_info'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'language_id' => 'Language ID',
            'products_name' => 'Products Name',
            'products_description' => 'Products Description',
            'products_tab_1' => 'Products Tab 1',
            'products_tab_2' => 'Products Tab 2',
            'products_tab_3' => 'Products Tab 3',
            'products_tab_4' => 'Products Tab 4',
            'products_tab_5' => 'Products Tab 5',
            'products_tab_6' => 'Products Tab 6',
            'products_url' => 'Products Url',
            'products_viewed' => 'Products Viewed',
            'products_head_title_tag' => 'Products Head Title Tag',
            'products_head_desc_tag' => 'Products Head Desc Tag',
            'products_head_keywords_tag' => 'Products Head Keywords Tag',
            'products_info' => 'Products Info',
        ];
    }
}
