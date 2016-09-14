<?php
namespace frontend\modules\sp\controllers\actions\admin;

use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionOrders
{
    public function actionOrders()
    {
        $referal = Referrals::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one();
        $this->layout = 'main-no-fixed';
        $model = ReferralsUser::find()->select([
            'partners_orders.id as ids',
            'partners_orders.status as order_status',
            'partners_users.status as user_status',
            'partners_referrals_users.*',
            'partners_users_info.*',
            'partners_orders.*'
        ])->joinWith('user')->joinWith('userinfo')->joinWith('order')->where(['referral_id'=>$referal['id']])->andWhere('partners_orders.id > 0');
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
        $pagesize= 7;
        if(($search = Yii::$app->request->getQueryParam('search')) == TRUE){
            $model->andWhere('name REGEXP "'.$search.'"');
            $model->orWhere('secondname REGEXP "'.$search.'"');
            $model->orWhere('lastname REGEXP "'.$search.'"');
        }
        $pages = new Pagination([
            'totalCount' => $model->count(),
        ]);
        $pages->setPageSize($pagesize);
        $dataprovider = new ArrayDataProvider([
            'allModels' => $model->limit($pagesize)->offset($pages->getOffset())->createCommand()->queryAll()
        ]);

        return $this->render('orders', ['data'=>$dataprovider, 'paginate'=>$pages]);
    }
}