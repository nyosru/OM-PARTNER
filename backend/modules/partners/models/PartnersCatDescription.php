<?php

namespace app\modules\partners\models;

use Yii;

/**
 * This is the model class for table "categories_description".
 *
 * @property string $categories_id
 * @property string $language_id
 * @property string $categories_name
 * @property string $categories_heading_title
 * @property string $categories_description
 * @property string $categories_meta_title
 * @property string $categories_meta_description
 * @property string $categories_meta_keywords
 */
class PartnersCatDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categories_id', 'language_id', 'categories_name'], 'required'],
            [['categories_id', 'language_id'], 'integer'],
            [['categories_description'], 'string'],
            [['categories_name', 'categories_heading_title', 'categories_meta_title', 'categories_meta_description', 'categories_meta_keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categories_id' => 'Categories ID',
            'language_id' => 'Language ID',
            'categories_name' => 'Categories Name',
            'categories_heading_title' => 'Categories Heading Title',
            'categories_description' => 'Categories Description',
            'categories_meta_title' => 'Categories Meta Title',
            'categories_meta_description' => 'Categories Meta Description',
            'categories_meta_keywords' => 'Categories Meta Keywords',
        ];
    }
}
