<?php
namespace frontend\modules\sp\controllers\actions\admin;

use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;


trait ActionAllClients
{
    public function actionAllClients()
    {
        $model = ReferralsUser::find()->joinWith('partnersReferralsUsers')->joinWith('partnersCommonOrders')->groupBy('user_id')->where(['user_id'=>Yii::$app->user->getId()]);

        $dataprovider = new ActiveDataProvider([
            'model' => $model
        ]);


        return $this->render('allclients', ['data'=>$dataprovider]);
    }
}