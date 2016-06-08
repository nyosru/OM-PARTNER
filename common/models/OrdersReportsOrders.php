<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "orders_reports_orders".
 *
 * @property string $orders_reports_id
 * @property string $orders_id
 * @property string $groups_id
 * @property string $bo_status
 * @property Orders $order
 * @property OrdersNidView $ordersNidView
 * @property OrdersReportsTested $ordersReportsTested
 */
class OrdersReportsOrders extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_reports_orders';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_reports_id', 'orders_id'], 'required'],
            [['orders_reports_id', 'orders_id', 'groups_id'], 'integer'],
            [['bo_status'], 'string'],
            [['orders_reports_id', 'orders_id'], 'unique', 'targetAttribute' => ['orders_reports_id', 'orders_id'], 'message' => 'The combination of Orders Reports ID and Orders ID has already been taken.']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_reports_id' => 'Orders Reports ID',
            'orders_id' => 'Orders ID',
            'groups_id' => 'Groups ID',
            'bo_status' => 'Bo Status',
        ];
    }
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['orders_id' => 'orders_id']);
    }
    public function getFiles()
    {
        return $this->hasMany(OrdersReportsOrdersFiles::className(), ['orders_reports_id' => 'orders_reports_id']);
    }
}