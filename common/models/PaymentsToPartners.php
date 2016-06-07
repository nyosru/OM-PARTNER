<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "payments_to_partners".
 *
 * @property integer $payment_id
 * @property integer $payment_type
 */
class PaymentsToPartners extends ActiveRecordExt
{
    //Нал
    const PAYMENT_TYPE_CASH = 1;
    //Безнал
    const PAYMENT_TYPE_CASHLESS = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_to_partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id'], 'required'],
            [['payment_id', 'payment_type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'payment_type' => 'Payment Type',
        ];
    }

    public static function primaryKey()
    {
        return [
            'payment_id'
        ];
    }

    /**
     * @param $payment_id
     * @param $payment_type
     * @return PaymentsToPartners
     * @throws ObjectException
     * @author Alexander Levin
     */
    public static function addPaymentType($payment_id, $payment_type)
    {
        $payment_to_partners = new self;
        $payment_to_partners->payment_id = $payment_id;
        $payment_to_partners->payment_type = $payment_type;
        if (!$payment_to_partners->save()) {
            throw new HttpException('Не удалось добавить тип платежа для регионала', $payment_to_partners->errors);
        }
        return $payment_to_partners;
    }
}