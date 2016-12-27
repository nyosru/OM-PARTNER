<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\PartnersUserInfoForm;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionIndex
{

    public function actionIndex()
    {
        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $this->layout = 'main-no-fixed';

        $model = ReferralsUser::find()->select([
            'partners_orders.id as ids',
            'partners_orders.status as order_status',
            'partners_referrals_users.status as user_status',
            'partners_referrals_users.*',
            'partners_users_info.*',
            'partners_orders.*',
            'partners_common_orders_links.*',
        ])
            ->joinWith('user')
            ->joinWith('userinfo')
            ->joinWith('order')
            ->joinWith('commonOrder')
            ->where(['referral_id' => $referal['id']])
            ->andWhere('partners_orders.id > 0')
        ;

        if (($ds = Yii::$app->request->getQueryParam('ds')) == true) {

            $valid = new DateValidator();
            $valid->format = 'Y-m-d';

            if ($valid->validate($ds)) {
                $model->andWhere(PartnersOrders::tableName().'.create_date >= "' . $ds.' 23-59-59"');
            }
        }

        if (($de = Yii::$app->request->getQueryParam('de')) == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($de)) {
                $model->andWhere(PartnersOrders::tableName().'.create_date <= "' . $de.' 23-59-59"');
            }
        }

        $search = mb_strtolower(trim(Yii::$app->request->getQueryParam('search')));

        if ($search == true && preg_match('/^[0-9\s]+/', $search)) {
            $model->andWhere(PartnersOrders::tableName().'.id REGEXP "' . $search . '"');
        }else if ($search == true && preg_match('/^[0-9a-zа-я\s]+$/iu', $search)) {
            $model->andWhere('LOWER(name) REGEXP "' . $search . '" OR LOWER(secondname) REGEXP "' . $search . '" OR LOWER(lastname) REGEXP "' . $search . '"');
        }

        $status = Yii::$app->request->getQueryParam('status');
        if (!is_null($status) && $status != '' && (integer)trim($status) >= 0) {
            $model->andWhere(['partners_orders.status' => $status]);
        }

        $data_provider = new ArrayDataProvider([
            'allModels' => $model->createCommand()->queryAll(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $data_provider->setSort([
            'defaultOrder' => [
                'create_date' =>  SORT_DESC,
            ],
            'attributes' => [
                'create_date'  => [
                    'desc' => ['partners_orders.create_date' => SORT_DESC],
                ],
                'status'       => [
                    'desc' => ['partners_orders.status' => SORT_DESC],
                ],
            ],
        ]);

        return $this->render('orders', ['data' => $data_provider]);

    }

}