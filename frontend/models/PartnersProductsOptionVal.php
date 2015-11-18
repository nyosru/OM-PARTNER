<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products_options_values".
 *
 * @property string $products_options_values_id
 * @property string $language_id
 * @property string $products_options_values_name
 * @property string $products_options_values_thumbnail
 */
class PartnersProductsOptionVal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_options_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id'], 'integer'],
            [['products_options_values_name'], 'required'],
            [['products_options_values_name', 'products_options_values_thumbnail'], 'string', 'max' => 255],
            [['products_options_values_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_options_values_id' => 'Products Options Values ID',
            'language_id' => 'Language ID',
            'products_options_values_name' => 'Products Options Values Name',
            'products_options_values_thumbnail' => 'Products Options Values Thumbnail',
        ];
    }
}
