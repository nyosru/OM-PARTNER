<?php
namespace frontend\modules\sp\controllers\actions\admin;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;
use yii\web\HttpException;


trait ActionDetailOrder
{
    public function actionDetailOrder()
    {
        $referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one();
        if(
        ($id = (int)Yii::$app->request->post('id')) == TRUE &&
        ($order = PartnersOrders::find()->where(['id'=>$id])->asArray()->one()) == TRUE &&
        ($referraluser = ReferralsUser::find()->where(['user_id'=>$order['user_id'], ReferralsUser::tableName().'.referral_id'=>$referal['id']])->joinWith('user')->joinWith('userinfo')->asArray()->one()) == TRUE
        ){
            if($order['order'] != 'LinlToOM'){
                $order['order'] = unserialize($order['order']);
               foreach ($order['order']['order'] as $key=>$value){
               }
            }
            if($order['delivery'] != 'LinlToOM'){
                $order['delivery'] = unserialize($order['delivery']);
            }
            $result = [
                'refus'=>$referraluser,
                'order'=>$order,
                'id'=>$id,
            ];

            $result = json_encode($result);
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            }
            return $result;
        }else{
            return false;
        }

    }
}