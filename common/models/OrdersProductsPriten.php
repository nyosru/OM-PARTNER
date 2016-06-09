<?php

namespace common\models;

use common\models\Orders;
use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders_products_priten".
 *
 * @property integer $orders_products_priten_id
 * @property integer $type  3 для комментария сборщика, 2 - для админа, 1 - для клиента
 * @property integer $author
 * @property integer $orders_products_id
 * @property string $orders_products_priten
 * @property string $date_add
 * @property integer $av
 * @property integer $cv
 *
 * @property OrdersProducts $ordersProduct
 */
class OrdersProductsPriten extends ActiveRecordExt
{
    const TYPE_CUSTOMER = 1;
    const TYPE_ADMINISTRATOR = 2;
    const TYPE_COLLECTOR = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_products_priten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_products_id'], 'required'],
            [['orders_products_priten_id', 'type', 'author', 'orders_products_id', 'av', 'cv'], 'integer'],
            [['orders_products_priten'], 'string'],
            [['date_add'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_products_priten_id' => 'Orders Products Priten ID',
            'type' => 'Type',
            'author' => 'Author',
            'orders_products_id' => 'Orders Products ID',
            'orders_products_priten' => 'Orders Products Priten',
            'date_add' => 'Date Add',
            'av' => 'Av',
            'cv' => 'Cv',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['orders_id' => 'orders_id'])->viaTable(OrdersProducts::tableName(), ['orders_products_id' => 'orders_products_id']);
    }

    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::className(), ['orders_products_id' => 'orders_products_id'])->from(OrdersProducts::tableName() . ' op');
    }

    public function getOrdersProduct()
    {
        return $this->hasOne(OrdersProducts::className(), ['orders_products_id' => 'orders_products_id']);
    }

    public function getOrdersProductsAttributes()
    {
        return $this->hasMany(OrdersProductsAttributes::className(), ['orders_products_id' => 'orders_products_id']);
    }

    public function getOrdersProductsPritenPhoto()
    {
        return $this->hasMany(OrdersProductsPritenPhoto::className(), ['orders_products_id' => 'orders_products_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(PartnersProducts::className(), ['products_id' => 'products_id'])->viaTable(OrdersProducts::tableName(), ['orders_products_id' => 'orders_products_id']);
    }
}
