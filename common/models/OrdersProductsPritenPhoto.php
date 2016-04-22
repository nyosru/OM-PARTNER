<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders_products_priten_photo".
 *
 * @property string $orders_products_priten_photo_id
 * @property string $customer_id
 * @property string $orders_products_id
 * @property string $date_add
 * @property string $image_name_server
 * @property string $image_name
 *
 * @property OrdersProducts $ordersProducts
 */
class OrdersProductsPritenPhoto extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_products_priten_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'orders_products_id', 'date_add', 'image_name_server', 'image_name'], 'required'],
            [['customer_id', 'orders_products_id'], 'integer'],
            [['date_add'], 'safe'],
            [['image_name_server'], 'string', 'max' => 80],
            [['image_name'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_products_priten_photo_id' => 'Orders Products Priten Photo ID',
            'customer_id' => 'Customer ID',
            'orders_products_id' => 'Orders Products ID',
            'date_add' => 'Date Add',
            'image_name_server' => 'Image Name Server',
            'image_name' => 'Image Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasOne(OrdersProducts::className(), ['orders_products_id' => 'orders_products_id']);
    }
}
