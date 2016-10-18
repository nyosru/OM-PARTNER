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
                if($result->validate()){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }

    }
}