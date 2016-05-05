<?php
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "admin_companies_bank_to_orders".
 *
 * @property integer $orders_id
 * @property integer $admin_companies_bank_id
 * @property integer $admin_companies_id
 * @property string $rs
 * @property string $ks
 * @property string $bik
 * @property string $adress
 * @property string $short_name
 *
 * @property Orders $orders
 * @property AdminCompaniesBank $bank
 */
class AdminCompaniesBankToOrders extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_companies_bank_to_orders';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'admin_companies_bank_id', 'admin_companies_id'], 'required'],
            [['orders_id', 'admin_companies_bank_id', 'admin_companies_id'], 'integer'],
            [['adress'], 'string'],
            [['rs', 'ks'], 'string', 'max' => 40],
            [['bik'], 'string', 'max' => 20],
            [['short_name'], 'string', 'max' => 8]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orders_id' => 'Orders ID',
            'admin_companies_bank_id' => 'Admin Companies Bank ID',
            'admin_companies_id' => 'Admin Companies ID',
            'rs' => 'Rs',
            'ks' => 'Ks',
            'bik' => 'Bik',
            'adress' => 'Adress',
            'short_name' => 'Short Name',
        ];
    }
    // RELATIONS BEGIN /////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::class, ['orders_id' => 'orders_id']);
    }
    /**
     * @return ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(AdminCompaniesBank::class, ['admin_companies_bank_id' => 'admin_companies_bank_id']);
    }
    // RELATIONS END ///////////////////////////////////////////////////////////////////////////////////////////////////
}