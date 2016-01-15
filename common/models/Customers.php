<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property string $customers_id
 * @property string $customers_gender
 * @property string $customers_firstname
 * @property string $customers_lastname
 * @property string $otchestvo
 * @property string $customers_dob
 * @property string $customers_email_address
 * @property integer $customers_default_address_id
 * @property integer $delivery_adress_id
 * @property integer $pay_adress_id
 * @property string $customers_telephone
 * @property string $customers_fax
 * @property string $customers_password
 * @property string $customers_newsletter
 * @property string $customers_selected_template
 * @property string $guest_flag
 * @property string $customers_discount
 * @property string $customers_groups_id
 * @property integer $customers_status
 * @property string $customers_payment_allowed
 * @property string $customers_shipment_allowed
 * @property string $referer
 * @property string $customers_mname
 * @property integer $default_provider
 * @property string $comment
 * @property string $separate_document
 * @property string $separate_deliv
 * @property string $separate_checkin
 * @property string $pay_priority
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customers_firstname', 'customers_lastname', 'customers_email_address', 'customers_telephone', 'customers_password', 'customers_selected_template'], 'required'],
            [['customers_dob'], 'safe'],
            [['customers_default_address_id', 'delivery_adress_id', 'pay_adress_id', 'customers_groups_id', 'customers_status', 'default_provider'], 'integer'],
            [['customers_discount'], 'number'],
            [['comment', 'separate_document', 'separate_deliv', 'separate_checkin', 'pay_priority'], 'string'],
            [['customers_gender', 'customers_newsletter', 'guest_flag'], 'string', 'max' => 1],
            [['customers_firstname', 'customers_lastname', 'customers_telephone', 'customers_fax', 'customers_payment_allowed', 'customers_shipment_allowed'], 'string', 'max' => 255],
            [['otchestvo'], 'string', 'max' => 128],
            [['customers_email_address'], 'string', 'max' => 96],
            [['customers_password'], 'string', 'max' => 40],
            [['customers_selected_template'], 'string', 'max' => 20],
            [['referer', 'customers_mname'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customers_id' => 'Customers ID',
            'customers_gender' => 'Customers Gender',
            'customers_firstname' => 'Customers Firstname',
            'customers_lastname' => 'Customers Lastname',
            'otchestvo' => 'Otchestvo',
            'customers_dob' => 'Customers Dob',
            'customers_email_address' => 'Customers Email Address',
            'customers_default_address_id' => 'Customers Default Address ID',
            'delivery_adress_id' => 'Delivery Adress ID',
            'pay_adress_id' => 'Pay Adress ID',
            'customers_telephone' => 'Customers Telephone',
            'customers_fax' => 'Customers Fax',
            'customers_password' => 'Customers Password',
            'customers_newsletter' => 'Customers Newsletter',
            'customers_selected_template' => 'Customers Selected Template',
            'guest_flag' => 'Guest Flag',
            'customers_discount' => 'Customers Discount',
            'customers_groups_id' => 'Customers Groups ID',
            'customers_status' => 'Customers Status',
            'customers_payment_allowed' => 'Customers Payment Allowed',
            'customers_shipment_allowed' => 'Customers Shipment Allowed',
            'referer' => 'Referer',
            'customers_mname' => 'Customers Mname',
            'default_provider' => 'Default Provider',
            'comment' => 'Comment',
            'separate_document' => 'Separate Document',
            'separate_deliv' => 'Separate Deliv',
            'separate_checkin' => 'Separate Checkin',
            'pay_priority' => 'Pay Priority',
        ];
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }
//    public function validatePassword($password)
//    {
//        return Yii::$app->security->validatePassword($password, $this->customers_password);
//    }

    public function validatePassword($plain)
    {
        if ($this->customers_migrate_not_null($plain) && $this->customers_migrate_not_null($this->customers_password)) {
            $stack = explode(':', $this->customers_password);
            if (sizeof($stack) != 2) return false;
            if (md5($stack[1] . $plain) == $stack[0]) {
                return true;
            }
        }
        return false;
    }

    public function encrypt_password($plain)
    {
        $password = '';

        for ($i = 0; $i < 10; $i++) {
            $password .= $this->customer_migrate_rand();
        }

        $salt = substr(md5($password), 0, 2);

        $password = md5($salt . $plain) . ':' . $salt;

        return $password;
    }

    public function customer_migrate_rand($min = null, $max = null)
    {
        static $seeded;
        if (!isset($seeded)) {
            mt_srand((double)microtime() * 1000000);
            $seeded = true;
        }

        if (isset($min) && isset($max)) {
            if ($min >= $max) {
                return $min;
            } else {
                return mt_rand($min, $max);
            }
        } else {
            return mt_rand();
        }
    }

    public function customers_migrate_not_null($value)
    {
        if (is_array($value)) {
            if (sizeof($value) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
