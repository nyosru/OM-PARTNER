<?php
namespace frontend\modules\sp\controllers\actions\admin;

use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;
use yii\web\HttpException;


trait ActionAddCommon
{
    public function actionAddCommon()
    {

        if(($referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one())==TRUE){
            $result = new CommonOrders();
            if($result->load(Yii::$app->request->post())){
                $result->referral_id = $referal['id'];
                $result->status = 1;
                if($result->save()){
                    return 'Общий заказ создан! Номер заказа : '.$result->id;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }

    }
}