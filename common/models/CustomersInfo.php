<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers_info".
 *
 * @property integer $customers_info_id
 * @property string $customers_info_date_of_last_logon
 * @property integer $customers_info_number_of_logons
 * @property string $customers_info_date_account_created
 * @property string $customers_info_date_account_last_modified
 * @property integer $global_product_notifications
 */
class CustomersInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customers_info_id'], 'required'],
            [['customers_info_id', 'customers_info_number_of_logons', 'global_product_notifications'], 'integer'],
            [['customers_info_date_of_last_logon', 'customers_info_date_account_created', 'customers_info_date_account_last_modified'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customers_info_id' => 'Customers Info ID',
            'customers_info_date_of_last_logon' => 'Customers Info Date Of Last Logon',
            'customers_info_number_of_logons' => 'Customers Info Number Of Logons',
            'customers_info_date_account_created' => 'Customers Info Date Account Created',
            'customers_info_date_account_last_modified' => 'Customers Info Date Account Last Modified',
            'global_product_notifications' => 'Global Product Notifications',
        ];
    }
}
