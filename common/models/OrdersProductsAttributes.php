<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_products_attributes".
 *
 * @property string $orders_products_attributes_id
 * @property string $orders_id
 * @property string $orders_products_id
 * @property string $products_options
 * @property string $products_options_values
 * @property string $options_values_price
 * @property string $price_prefix
 * @property integer $oid
 * @property integer $vid
 * @property string $sub_vid
 * @property string $products_sub_options_values
 */
class OrdersProductsAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_products_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'orders_products_id', 'oid', 'vid', 'sub_vid'], 'integer'],
            [['products_options', 'products_options_values'], 'required'],
            [['products_options_values', 'products_sub_options_values'], 'string'],
            [['options_values_price'], 'number'],
            [['products_options'], 'string', 'max' => 255],
            [['price_prefix'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_products_attributes_id' => 'Orders Products Attributes ID',
            'orders_id' => 'Orders ID',
            'orders_products_id' => 'Orders Products ID',
            'products_options' => 'Products Options',
            'products_options_values' => 'Products Options Values',
            'options_values_price' => 'Options Values Price',
            'price_prefix' => 'Price Prefix',
            'oid' => 'Oid',
            'vid' => 'Vid',
            'sub_vid' => 'Sub Vid',
            'products_sub_options_values' => 'Products Sub Options Values',
        ];
    }
    public function GetId()
    {
        return $this->orders_products_attributes_id;
    }
}
