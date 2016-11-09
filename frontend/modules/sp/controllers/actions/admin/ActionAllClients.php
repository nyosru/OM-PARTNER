<?php
namespace frontend\modules\sp\controllers\actions\admin;

use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;


trait ActionAllClients
{
    public function actionAllClients()
    {
        $referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one();


        $this->layout = 'main-no-fixed';

        $model = ReferralsUser::find()->joinWith('user')->joinWith('userinfo')->joinWith('lastOrder')->joinWith('order')->where(['referral_id'=>$referal['id']])->groupBy('user_id');

        if(($ds = Yii::$app->request->getQueryParam('ds')) == TRUE){
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if($valid->validate($ds)) {
                $model->andWhere('date_added >= "'.$ds.'"');
            }
        }

        if(($de = Yii::$app->request->getQueryParam('de')) == TRUE){
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if($valid->validate($de)) {
                $model->andWhere('date_added < "'.$de.'"');
            }
        }

        if(($sort = Yii::$app->request->getQueryParam('sort')) == TRUE && ($vect = Yii::$app->request->getQueryParam('vect')) == TRUE){

            $sort = new Sort([
                'attributes' => [
                    'status'
                ],
            ]);

            
        }

        if(
            ($search = Yii::$app->request->getQueryParam('search')) == TRUE &&
            (preg_match('[a-z а-я \-]/i',$search))
        ){

            $model->andWhere('name REGEXP "'.$search.'"');
            $model->orWhere('secondname REGEXP "'.$search.'"');
            $model->orWhere('lastname REGEXP "'.$search.'"');
        }

        $dataprovider = new ActiveDataProvider([
            'query' => $model,
            'pagination'=> [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('allclients', ['data'=>$dataprovider]);
    }
}