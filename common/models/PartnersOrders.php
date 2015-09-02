<?php

namespace common\models;

use Yii;

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
            'orders_id' => 'OrdersID'
        ];
    }
}
