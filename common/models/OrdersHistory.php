<?php

namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders_history".
 *
 * @property integer $orders_history_id
 * @property integer $orders_id
 * @property string $new_oid_old
 * @property string $new_oid_new
 * @property string $orders_history_date
 * @property integer $admin_id
 * @property string $orders_history_text
 * @property string $referer_page
 * @property string $storage
 */
class OrdersHistory extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'orders_history_date', 'orders_history_text', 'referer_page'], 'required'],
            [['orders_id', 'admin_id'], 'integer'],
            [['orders_history_date'], 'safe'],
            [['orders_history_text'], 'string'],
            [['new_oid_old', 'new_oid_new'], 'string', 'max' => 12],
            [['referer_page'], 'string', 'max' => 200],
            [['storage'], 'string', 'max' => 48]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_history_id' => 'Orders History ID',
            'orders_id' => 'Orders ID',
            'new_oid_old' => 'New Oid Old',
            'new_oid_new' => 'New Oid New',
            'orders_history_date' => 'Orders History Date',
            'admin_id' => 'Admin ID',
            'orders_history_text' => 'Orders History Text',
            'referer_page' => 'Referer Page',
            'storage' => 'Storage',
        ];
    }
}
