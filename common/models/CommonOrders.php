<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_common_orders".
 *
 * @property integer $id
 * @property integer $referral_id
 * @property string $header
 * @property string $description
 * @property string $comments
 * @property string $date_added
 * @property string $date_available
 * @property string $date_modified
 * @property integer $status
 *
 * @property Referrals $referral
 * @property CommonOrdersLinks[] $partnersCommonOrdersLinks
 */
class CommonOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_common_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['referral_id', 'status'], 'integer'],
            [['date_added', 'date_available', 'date_modified'], 'safe'],
            [['header', 'description', 'comments'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referral_id' => 'Referral ID',
            'header' => 'Header',
            'description' => 'Description',
            'comments' => 'Comments',
            'date_added' => 'Date Added',
            'date_available' => 'Date Available',
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
    public function getPartnersCommonOrdersLinks()
    {
        return $this->hasMany(CommonOrdersLinks::className(), ['common_orders_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerOrders()
    {
        return $this->hasMany(PartnersOrders::className(), ['id' => 'partner_orders_id'])
            ->via('partnersCommonOrdersLinks');
    }

}
