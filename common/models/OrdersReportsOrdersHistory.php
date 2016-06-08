<?php
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;


/**
 * This is the model class for table "orders_reports_orders_history".
 *
 * @property string $orders_reports_orders_history_id
 * @property string $orders_reports_id
 * @property string $orders_id
 */
class OrdersReportsOrdersHistory extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_reports_orders_history';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_reports_id', 'orders_id'], 'required'],
            [['orders_reports_id', 'orders_id'], 'integer'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_reports_orders_history_id' => 'Orders Reports Orders History ID',
            'orders_reports_id' => 'Orders Reports ID',
            'orders_id' => 'Orders ID',
        ];
    }
}