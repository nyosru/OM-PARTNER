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


trait ActionIndex
{

    public function actionIndex()
    {
        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $this->layout = 'main-no-fixed';

        $model = ReferralsUser::find()->select([
            'partners_orders.id as ids',
            'partners_orders.status as order_status',
            'partners_users.status as user_status',
            'partners_referrals_users.*',
            'partners_users_info.*',
            'partners_orders.*',
        ])->joinWith('user')->joinWith('userinfo')->joinWith('order')->where(['referral_id' => $referal['id']])
            ->andWhere('partners_orders.id > 0')
        ;

        if (($ds = Yii::$app->request->getQueryParam('ds')) == true) {

            $valid = new DateValidator();
            $valid->format = 'Y-m-d';

            if ($valid->validate($ds)) {
                $model->andWhere('date_added >= "' . $ds . '"');
            }
        }

        if (($de = Yii::$app->request->getQueryParam('de')) == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($de)) {
                $model->andWhere('date_added <= "' . $de . '"');
            }
        }

        $pagesize = 5;

        $search = trim(Yii::$app->request->getQueryParam('search'));

        if ($search == true && preg_match('([A-Za-zА-Яа-я])', $search)) {
            $model->andWhere('name REGEXP "' . $search . '"');
            $model->orWhere('secondname REGEXP "' . $search . '"');
            $model->orWhere('lastname REGEXP "' . $search . '"');
        }

        $status = trim(Yii::$app->request->getQueryParam('status'));

        if (!empty($status) && $status >= 0) {
            $model->andWhere(['partners_orders.status' => $status]);
        }

        $pages = new Pagination([
            'totalCount' => $model->count(),
        ]);

        $pages->setPageSize($pagesize);

        $data_provider = new ArrayDataProvider([
            'allModels' => $model->limit($pagesize)->offset($pages->getOffset())->createCommand()->queryAll(),
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

        return $this->render('orders', ['data' => $data_provider, 'paginate' => $pages]);

    }

}