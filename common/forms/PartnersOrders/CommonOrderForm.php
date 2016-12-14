<?php

namespace common\forms\PartnersOrders;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\base\Model;


class CommonOrderForm extends Model
{
    public $header;
    public $description;

    public function rules()
    {
        return [
            ['header', 'required', 'message' => 'Необходимо заполнить'],
            [['header', 'description'], 'string'],
        ];
    }

    public function createCommonOrder()
    {
        if (!$this->validate()) {
            return false;
        }

        $referral = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        if(!$referral) {
           return false;
        }

        $newCommonOrder = new CommonOrders();
        $newCommonOrder->referral_id = $referral['id'];
        $newCommonOrder->status = 1;
        $newCommonOrder->header = $this->header ?: '';
        $newCommonOrder->description = $this->description ?: '';

        if ($newCommonOrder->save()) {
            return true;
        }

        return false;

    }

}