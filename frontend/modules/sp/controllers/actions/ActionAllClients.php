<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\validators\DateValidator;

trait ActionAllClients
{
    public function actionAllClients()
    {
        $this->layout = 'main-no-fixed';

        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $query = ReferralsUser::find()
                              ->joinWith('user')
                              ->joinWith('userinfo')
                              ->joinWith('lastOrder')
                              ->joinWith('order')
                              ->where(['referral_id' => $referal['id']])
                              ->groupBy('user_id')
        ;

        $ds = Yii::$app->request->getQueryParam('ds');

        if ($ds == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($ds)) {
                $query->andWhere('date_added >= "'.$ds.' 23-59-59"');
            }
        }

        $de = Yii::$app->request->getQueryParam('de');

        if ($de == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($de)) {
                $query->andWhere('date_added <= "'.$de.' 23-59-59"');
            }
        }

        $search = trim(Yii::$app->request->getQueryParam('search'));

        if ($search == true && preg_match('([A-Za-zА-Яа-я])', $search)) {
            $query->andWhere('name REGEXP "'.$search.'"');
            $query->orWhere('secondname REGEXP "'.$search.'"');
            $query->orWhere('lastname REGEXP "'.$search.'"');
        }

        $status = trim(Yii::$app->request->getQueryParam('status'));

        if ( !empty($status)) {
            $query->andWhere(['partners_referrals_users.status' => $status]);
        }

        $data_provider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $data_provider->setSort([
            'defaultOrder' => [
                'create_date' =>  SORT_DESC,
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

        return $this->render('allclients',
            [
                'data_provider' => $data_provider,
            ]);
    }
}