<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "coupon_redeem_track".
 *
 * @property integer $unique_id
 * @property integer $coupon_id
 * @property integer $customer_id
 * @property string $redeem_date
 * @property string $redeem_ip
 * @property integer $order_id
 */
class CouponRedeemTrack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_redeem_track';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'redeem_date',
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'customer_id', 'order_id'], 'integer'],
            [['redeem_date'], 'safe'],
            [['redeem_ip'], 'required'],
            [['redeem_ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unique_id' => 'Unique ID',
            'coupon_id' => 'Coupon ID',
            'customer_id' => 'Customer ID',
            'redeem_date' => 'Redeem Date',
            'redeem_ip' => 'Redeem Ip',
            'order_id' => 'Order ID',
        ];
    }
}
