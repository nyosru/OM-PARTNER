<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "partners_orders".
 *
 * @property integer $id
 * @property integer $partners_id
 * @property integer $user_id
 * @property resource $order
 */
class PartnersOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partners_id', 'user_id', 'status', 'orders_id'], 'integer'],
            [['order','delivery'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partners_id' => 'Partners ID',
            'user_id' => 'User ID',
            'order' => 'Order',
            'status' => 'Status',
            'delivery' => 'Delivery',

        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserDescription()
    {
        return $this->hasOne(PartnersUsersInfo::className(), ['id' => 'user_id']);
    }

    public function getOMOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }

    public function getOMOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::className(), ['orders_id' => 'orders_id'])->via('oMOrders');
    }

    public function getOMOrdersProductsAttr()
    {
        return $this->hasMany(OrdersProductsAttributes::className(), ['orders_products_id' => 'orders_products_id'])->via('oMOrdersProducts');
    }
}
