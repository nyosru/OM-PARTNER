<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders_products_sp".
 *
 * @property string $orders_products_id
 * @property integer $products_quantity
 * @property integer $orders_products_id_sp
 * @property string $orders_id
 * @property string $orders_id_sp
 */
class PartnersOrdersProductsSp extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_products_sp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['orders_id', 'default'],
            ['orders_id_sp', 'default', 'value' => function () {
                return (isset($this->ordersProductsSP) ? $this->ordersProductsSP->orders_id : null);
            }, 'when' => function () {
                return isset($this->ordersProductsSP);
            }],
            [['orders_products_id', 'orders_products_id_sp', 'orders_id', 'orders_id_sp'], 'required'],
            [['orders_products_id', 'orders_products_id_sp', 'orders_id', 'orders_id_sp'], 'integer'],
            ['products_quantity', 'integer', 'min' => 0],
            [['orders_products_id', 'orders_products_id_sp'], 'exist', 'targetAttribute' => 'orders_products_id', 'targetClass' => OrdersProducts::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_products_id' => 'Orders Products ID',
            'products_quantity' => 'Products Quantity',
            'orders_products_id_sp' => 'Orders Products Id Sp',
            'orders_id' => 'Orders ID',
            'orders_id_sp' => 'Orders Id Sp',
        ];
    }
}