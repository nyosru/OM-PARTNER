<?php
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "orders_status_history".
 *
 * @property integer $orders_status_history_id
 * @property string $orders_id
 * @property integer $orders_status_id
 * @property string $date_added
 * @property integer $customer_notified
 * @property string $comments
 * @property string $private_comments
 * @property integer $admin_id
 * @property string $storage
 */
class OrdersStatusHistory extends ActiveRecordExt
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_status_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'orders_status_id', 'customer_notified', 'admin_id'], 'integer'],
            [['date_added'], 'date'],
            [['comments', 'private_comments'], 'string'],
            [['storage'], 'string', 'max' => 24]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_status_history_id' => 'Orders Status History ID',
            'orders_id' => 'Orders ID',
            'orders_status_id' => 'Orders Status ID',
            'date_added' => 'Date Added',
            'customer_notified' => 'Customer Notified',
            'comments' => 'Comments',
            'private_comments' => 'Private Comments',
            'admin_id' => 'Admin ID',
            'storage' => 'Storage',
        ];
    }
}