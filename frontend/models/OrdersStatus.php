<?php

namespace common\models;

use Yii;


/**
 * This is the model class for table "orders_status".
 *
 * @property integer $orders_status_id
 * @property integer $language_id
 * @property string $orders_status_name
 * @property integer $storproject
 * @property integer $safe_custody
 *
 * @property OrdersStatusHistory[] $ordersStatusHistories
 */
class OrdersStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_status_id', 'language_id', 'orders_status_name'], 'required'],
            [['orders_status_id', 'language_id'], 'integer'],
            [['orders_status_id', 'language_id', 'safe_custody'], 'integer'],
            [['orders_status_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_status_id' => 'Orders Status ID',
            'language_id' => 'Language ID',
            'orders_status_name' => 'Orders Status Name',
            'safe_custody' => 'safe_custody',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

}
