<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_referrals".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $customer_id
 * @property string $referral_url
 * @property integer $min_order
 * @property integer $percent
 * @property integer $discount
 * @property string $date_added
 * @property string $date_modified
 * @property integer $status
 *
 * @property PartnersCommonOrders[] $partnersCommonOrders
 * @property PartnersUsers $user
 * @property PartnersReferralsUsers[] $partnersReferralsUsers
 */
class Referrals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_referrals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'customer_id', 'min_order', 'percent', 'discount', 'status'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['referral_url'], 'string', 'max' => 255],
            [['user_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'customer_id' => 'Customer ID',
            'referral_url' => 'Referral Url',
            'min_order' => 'Min Order',
            'percent' => 'Percent',
            'discount' => 'Discount',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnersCommonOrders()
    {
        return $this->hasMany(PartnersCommonOrders::className(), ['referral_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(PartnersUsers::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnersReferralsUsers()
    {
        return $this->hasMany(PartnersReferralsUsers::className(), ['referral_id' => 'id']);
    }
}
