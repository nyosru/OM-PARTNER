<?php
namespace common\models;
use common\patch\ActiveRecordExt;

/**
 * This is the model class for table "orders_reports".
 *
 * @property string $orders_reports_id
 * @property integer $orders_reports_status
 * @property string $orders_reports_date
 * @property string $status_time
 * @property integer $orders_reports_active
 * @property integer $bo_status
 * @property integer $documents_status
 *
 * @property PartnersCompanies[] $regionals
 * @property Orders[] $orders
 * @property int $docsStatus
 */
class OrdersReports extends ActiveRecordExt
{
 
    const ACTS_STATUS_AWAIT = 0;       //ожидание генерации
    const ACTS_STATUS_SUCCESS = 1;     //генерация всех актов прошла успешно
    const ACTS_STATUS_PROCESSING = 2;  //генерация актов идёт прямо в данный момент. Если у нескольких отчётов этот статус одновременно - явное указание на ошибку.
    const ACTS_STATUS_INCOMPLETE = 3;  //генерация всех актов прошла, но в отчёте присутствуют не все акты
    //...-99 зарезервированы
    const ACTS_STATUS_ERROR = 100;      //генерация прошла с ошибкой (неизвестной)
    //статусы >=100 зарезервированы под коды ошибок
    const ACTS_STATUS_ERROR_INCORRECT_DATE = 101;
    const BO_STATUS_READY = 3; // статус бух. отчёта для разрешения генерации актов после прошествия BO_STATUS_READY_HOURS часов
    const BO_STATUS_READY_HOURS = 48; // кол-во часов, должное пройти после смены статуса бух. отчёта на BO_STATUS_READY для разрешения генерации актов
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_reports';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_reports_status', 'bo_status'], 'default', 'value' => 1],
            [['orders_reports_active', 'documents_status'], 'default', 'value' => 0],
            [['orders_reports_status', 'orders_reports_active', 'bo_status'], 'integer'],
            [['orders_reports_date'], 'required'],
            [['orders_reports_date', 'status_time'], 'safe']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_reports_id' => 'Orders Reports ID',
            'orders_reports_status' => 'Orders Reports Status',
            'orders_reports_date' => 'Orders Reports Date',
            'status_time' => 'Status Time',
            'orders_reports_active' => 'Orders Reports Active',
            'bo_status' => 'Bo Status',
        ];
    }
  
    /**
     * @return int
     */
  
    /**
     * @inheritdoc
     */
    // RELATIONS BEGIN /////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(PartnersProducts::class, ['products_id' => 'products_id'])->via('ordersProducts');
    }
    /**
     * @return ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::class, ['orders_id' => 'orders_id'])->via('orders');
    }
    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['orders_id' => 'orders_id'])->via('ordersReportsOrders');
    }
    /**
     * @return ActiveQuery
     */
    public function getOrdersReportsOrders()
    {
        return $this->hasMany(OrdersReportsOrders::class, ['orders_reports_id' => 'orders_reports_id']);
    }
    /**
     * @return ActiveQuery
     */
    public function getOrdersToPartners()
    {
        return $this->hasMany(OrdersToPartners::class, ['order_id' => 'orders_id'])->via('orders');
    }
    /**
     * @return ActiveQuery
     */
    public function getRegionals()
    {
        return $this->hasMany(PartnersCompanies::class, ['partner_id' => 'partner_id'])->via('ordersToPartners');
    }
    // RELATIONS END ///////////////////////////////////////////////////////////////////////////////////////////////////
}