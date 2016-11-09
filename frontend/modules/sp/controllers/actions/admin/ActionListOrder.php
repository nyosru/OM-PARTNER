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


trait ActionListOrder
{
    public function actionListOrder()
    {

        if(($referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one())==TRUE){
            $result = CommonOrders::find()->where(['referral_id'=>$referal])->orderBy('date_added DESC')->limit(5)->asArray()->all();
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            }
            return $result;
        }else{
            return false;
        }

    }
}