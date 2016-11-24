<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_referrals_users".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $referral_id
 * @property string $info
 * @property integer $discount
 * @property string $date_added
 * @property string $date_modified
 * @property integer $status
 *
 * @property Referrals $referral
 * @property User $user
 */
class ReferralsUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_referrals_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'referral_id', 'discount', 'status'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['info'], 'string', 'max' => 255],
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
            'referral_id' => 'Referral ID',
            'info' => 'Info',
            'discount' => 'Discount',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferral()
    {
        return $this->hasOne(Referrals::className(), ['id' => 'referral_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
   
    public function getLastOrder()
    {
        return $this->hasOne(PartnersOrders::className(), ['user_id' => 'id'])->limit(1)->orderBy('partners_orders.id DESC')->via('user');
    }

    public function getUserinfo()
    {
        return $this->hasOne(PartnersUsersInfo::className(), ['id' => 'id'])->via('user');
    }
    public function getOrder()
    {
        return $this->hasMany(PartnersOrders::className(), ['user_id' => 'id'])->orderBy('partners_orders.id DESC')->via('user');
    }
}
