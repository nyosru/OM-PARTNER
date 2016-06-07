<?php
namespace common\models;
use common\patch\ActiveRecordExt;
use Yii;
/**
 * This is the model class for table "last_partners_ids".
 *
 * @property integer $partner_id
 * @property integer $region_id
 * @property integer $year
 * @property integer $order_id
 * @property integer $act_id
 * @property integer $order_act
 */
class LastPartnersIds extends ActiveRecordExt
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'last_partners_ids';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_id', 'region_id', 'year'], 'required'],
            [['partner_id', 'region_id', 'year', 'order_id', 'act_id', 'order_act'], 'integer']
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partner_id' => 'Partner ID',
            'region_id' => 'Region ID',
            'year' => 'Year',
            'order_id' => 'Order ID',
            'act_id' => 'Act ID',
            'order_act' => 'Order Act',
        ];
    }

    public function getPartnerscompanies()
    {
        return $this->hasOne(PartnersCompanies::class, ['partner_id' => 'partner_id']);
    }
}