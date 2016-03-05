<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "products_attributes".
 *
 * @property string $products_attributes_id
 * @property string $products_id
 * @property string $options_id
 * @property string $options_values_id
 * @property string $sub_options_values_id
 * @property string $options_values_price
 * @property string $price_prefix
 * @property integer $products_options_sort_order
 * @property integer $product_attributes_one_time
 * @property string $products_attributes_weight
 * @property string $products_attributes_weight_prefix
 * @property integer $products_attributes_units
 * @property string $products_attributes_units_price
 * @property integer $quantity
 */
class PartnersProductsAttributes extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'price_prefix', 'products_attributes_weight_prefix'], 'required'],
            [['products_id', 'options_id', 'options_values_id', 'sub_options_values_id', 'products_options_sort_order', 'product_attributes_one_time', 'products_attributes_units', 'quantity'], 'integer'],
            [['options_values_price', 'products_attributes_weight', 'products_attributes_units_price'], 'number'],
            [['price_prefix', 'products_attributes_weight_prefix'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_attributes_id' => 'Products Attributes ID',
            'products_id' => 'Products ID',
            'options_id' => 'Options ID',
            'options_values_id' => 'Options Values ID',
            'sub_options_values_id' => 'Sub Options Values ID',
            'options_values_price' => 'Options Values Price',
            'price_prefix' => 'Price Prefix',
            'products_options_sort_order' => 'Products Options Sort Order',
            'product_attributes_one_time' => 'Product Attributes One Time',
            'products_attributes_weight' => 'Products Attributes Weight',
            'products_attributes_weight_prefix' => 'Products Attributes Weight Prefix',
            'products_attributes_units' => 'Products Attributes Units',
            'products_attributes_units_price' => 'Products Attributes Units Price',
            'quantity' => 'Quantity',
        ];
    }

    public function getProdAttributes()
    {
        return $this->hasOne(PartnersProductsOptionVal::className(), ['products_attributes_id' => 'products_options_values_id']);
    }
}
