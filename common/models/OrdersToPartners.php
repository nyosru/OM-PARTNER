<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

/**
 * This is the model class for table "orders_to_partners".
 *
 * @property integer $order_id
 * @property integer $partner_id
 * @property integer $region_id
 * @property string $order_name
 * @property integer $order_number
 *
 * @property PartnersCompanies $partnersCompanies
 */
class OrdersToPartners extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_to_partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'partner_id', 'region_id', 'order_name'], 'required'],
            [['order_id', 'partner_id', 'region_id', 'order_number'], 'integer'],
            [['order_name'], 'string', 'max' => 255],
            [['order_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'partner_id' => 'Partner ID',
            'region_id' => 'Region ID',
            'order_name' => 'Order Name',
            'order_number' => 'Order Number',
        ];
    }

    public function getPartnersCompanies()
    {
        return $this->hasOne(PartnersCompanies::class, ['partner_id' => 'partner_id']);
    }
}