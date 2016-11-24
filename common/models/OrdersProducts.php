<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders_products".
 *
 * @property string $orders_products_id
 * @property integer $orders_id
 * @property string $sub_orders_id
 * @property integer $old_orders_id
 * @property integer $products_id
 * @property string $products_model
 * @property string $products_name
 * @property string $products_price
 * @property string $final_price
 * @property double $price_coll
 * @property string $products_tax
 * @property integer $products_quantity
 * @property integer $products_av
 * @property string $products_sort
 * @property string $priten
 * @property integer $checks
 * @property integer $first_quant
 * @property integer $products_status
 * @property integer $verificatiuon
 * @property string $comment
 * @property string $status_add
 * @property string $admin_sver
 * @property string $stickers_confirmed
 * @property string $automatically_sent_to_manufacturer
 */
class OrdersProducts extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'sub_orders_id', 'old_orders_id', 'products_id', 'products_quantity', 'products_av', 'checks', 'first_quant', 'products_status', 'verificatiuon', 'status_add', 'stickers_confirmed'], 'integer'],
            [['products_name'], 'required'],
            [['products_price', 'final_price', 'price_coll', 'products_tax'], 'number'],
            [['priten', 'comment'], 'string'],
            [['products_model', 'products_name', 'admin_sver'], 'string', 'max' => 255],
            [['products_sort'], 'string', 'max' => 20],
            ['automatically_sent_to_manufacturer', 'integer', 'min' => 0, 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_products_id' => 'Orders Products ID',
            'orders_id' => 'Orders ID',
            'sub_orders_id' => 'Sub Orders ID',
            'old_orders_id' => 'Old Orders ID',
            'products_id' => 'Products ID',
            'products_model' => 'Products Model',
            'products_name' => 'Products Name',
            'products_price' => 'Products Price',
            'final_price' => 'Final Price',
            'price_coll' => 'Price Coll',
            'products_tax' => 'Products Tax',
            'products_quantity' => 'Products Quantity',
            'products_av' => 'Products Av',
            'products_sort' => 'Products Sort',
            'priten' => 'Priten',
            'checks' => 'Checks',
            'first_quant' => 'First Quant',
            'products_status' => 'Products Status',
            'verificatiuon' => 'Verificatiuon',
            'comment' => 'Comment',
            'status_add' => 'Status Add',
            'admin_sver' => 'Admin Sver',
            'stickers_confirmed' => 'Stickers Confirmed',
            'automatically_sent_to_manufacturer' => 'Automatically Sent To Manufacturer',
        ];
    }

    public function getProducts()
    {
        return $this->hasOne(PartnersProducts::className(), ['products_id' => 'products_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }

    public function getOrdersProductsPriten()
    {
        return $this->hasMany(OrdersProductsPriten::className(), ['orders_products_id' => 'orders_products_id']);
    }
}
