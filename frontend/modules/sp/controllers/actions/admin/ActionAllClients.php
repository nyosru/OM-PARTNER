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
        $referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one();
//
//        '0' => [
//        'id' => ' Егоров Дмитрий Владимирович',
//        'key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.']
//        'value' => '1', 
//        'description' => '45000руб.', 
//        'jo'=>'вип клиент', 
//        'ko' =>'10 августа 2016' ],
//           
//        
        $model = ReferralsUser::find()->joinWith('user')->joinWith('userinfo')->joinWith('lastOrder')->joinWith('order')->where(['referral_id'=>$referal['id']]);

        $dataprovider = new ActiveDataProvider([
            'query' => $model
        ]);
        $data = $dataprovider->getModels();
        $paginate = $dataprovider->getPagination();

        return $this->render('allclients', ['data'=>$data, 'paginate'=> $paginate]);
    }
}