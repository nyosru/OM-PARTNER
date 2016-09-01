<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners_common_orders_links".
 *
 * @property integer $id
 * @property integer $common_orders_id
 * @property integer $partner_orders_id
 * @property string $comments
 * @property string $date_added
 * @property string $date_modified
 * @property integer $status
 *
 * @property CommonOrders $commonOrders
 * @property PartnersOrders $partnerOrders
 */
class CommonOrdersLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners_common_orders_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['common_orders_id', 'partner_orders_id', 'status'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['comments'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'common_orders_id' => 'Common Orders ID',
            'partner_orders_id' => 'Partner Orders ID',
            'comments' => 'Comments',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonOrders()
    {
        return $this->hasOne(CommonOrders::className(), ['id' => 'common_orders_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerOrders()
    {
        return $this->hasOne(PartnersOrders::className(), ['id' => 'partner_orders_id']);
    }
}
