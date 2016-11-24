<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersUserInfoForm;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionOrders
{
    public function actionOrders()
    {

        $this->layout = 'main-no-fixed';

        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $query = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referal['id']])
            ->joinWith('lastOrder')
            ->joinWith('order')
            ->indexBy('user_id')
            ->groupBy('user_id')
        ;

        $user_id = Yii::$app->request->getQueryParam('user_id');

        $query_user = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referal['id']])
        ;

        if ($user_id == true) {
            $query_user = $query_user->andWhere(['user_id' => $user_id]);
        }

        $query_user = $query_user->limit(1)->groupBy('user_id')->one();

        $ds = Yii::$app->request->getQueryParam('ds');

        if ($ds == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($ds)) {
                $query->andWhere('date_added >= "' . $ds . '"');
            }
        }

        $de = Yii::$app->request->getQueryParam('de');

        if ($de == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($de)) {
                $query->andWhere('date_added <= "' . $de . '"');
            }
        }

        $search = trim(Yii::$app->request->getQueryParam('search'));

        if ($search == true && preg_match('([A-Za-zА-Яа-я])', $search)) {
            $query->andWhere('name REGEXP "' . $search . '"');
            $query->orWhere('secondname REGEXP "' . $search . '"');
            $query->orWhere('lastname REGEXP "' . $search . '"');
        }

        $status = trim(Yii::$app->request->getQueryParam('status'));

        if (!empty($status)) {
            $query->andWhere(['partners_referrals_users.status' => $status]);
        }

        $data_provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $data_provider->setPagination(false);

        $data_provider->setSort([
            'defaultOrder' => [
                'date_added' =>  SORT_DESC,
            ],
            'attributes' => [
                'secondname'   => [
                    'desc' => ['partners_users_info.secondname' => SORT_DESC],
                ],
                'create_date'  => [
                    'desc' => ['partners_orders.create_date' => SORT_DESC],
                ],
                'date_added'   => [
                    'desc' => ['partners_referrals_users.date_added' => SORT_DESC],
                ],
                'status'       => [
                    'desc' => ['partners_referrals_users.status' => SORT_DESC],
                ],
            ],
        ]);

        $model_form_partners_user_info = new PartnersUserInfoForm($query_user->userinfo);

        return $this->render('index',
            [
                'data_provider'                 => $data_provider,
                'query_user'                    => $query_user,
                'model_form_partners_user_info' => $model_form_partners_user_info,
            ]);
        }
}