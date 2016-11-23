<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionCommonOrders
{
    public function actionCommonOrders()
    {
        $this->layout = 'main-no-fixed';

        $referral = Referrals::find()
            ->where(['user_id' => Yii::$app->user->getId()])
            ->asArray()
            ->one()
        ;

        $model = CommonOrders::find()
            ->where(['referral_id' => $referral['id']])
            ->joinWith('partnerOrders')
        ;

        $ds = Yii::$app->request->getQueryParam('ds');
        if ($ds == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($ds)) {
                $model->andWhere('date_added >= "' . $ds . '"');
            }
        }

        $de = Yii::$app->request->getQueryParam('de');

        if ($de == true) {
            $valid = new DateValidator();
            $valid->format = 'Y-m-d';
            if ($valid->validate($de)) {
                $model->andWhere('date_added < "' . $de . '"');
            }
        }

        $search = Yii::$app->request->getQueryParam('search');

        if ($search == true) {
            $model->andWhere('header REGEXP "' . $search . '"');
            $model->orWhere('description REGEXP "' . $search . '"');
        }
        $pagesize = 5;
        $pages = new Pagination([
            'totalCount' => $model->count(),
        ]);

        $pages->setPageSize($pagesize);
        $data_provider = new ActiveDataProvider([
            'query' => $model->limit($pagesize)->offset($pages->getOffset())
        ]);

        $data_provider->setPagination($pages);

        $data_provider->setSort([
            'defaultOrder' => [
                'date_added' =>  SORT_DESC,
            ],
            'attributes' => [
                'date_added'   => [
                    'desc' => [CommonOrders::tableName() . '.date_added' => SORT_DESC],
                ],
                'status'       => [
                    'desc' => [CommonOrders::tableName() . '.status' => SORT_DESC],
                ],
            ],
        ]);

        return $this->render('orderscommon', ['data' => $data_provider, 'paginate' => $pages]);
    }
}