<?php
namespace frontend\modules\lk\controllers\actions\sp;

use common\models\PartnersOrders;
use common\models\ReferralsUser;
use common\models\User;
use yii;


trait ActionMyorder
{
    public function actionMyorder()
    {
        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->one()) == FALSE) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $sort = new yii\data\Sort([
            'attributes' => [
                'orders_id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'default' => SORT_DESC,

                ],
            ],
        ]);
        $model = PartnersOrders::find()->where(['user_id' => Yii::$app->getUser()->id]);
        $sort_order = [0 => 'Все', 1 => 'Текущие', 2 => 'Не оплачено', 3 => 'Завершенные'];
        $search = (int)Yii::$app->request->getQueryParam('filter');
        if ($search) {
            switch ($search) {
                case '0':
                    $model = $model->andWhere(['!=', 'status', '0']);
                    break;
                case '1':
                    $statinfilter = [1, 2, 3, 4, 5, 11];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '2':
                    $statinfilter = [1, 2];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '3':
                    $statinfilter = [5, 6, 33];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '4':
                    $statinfilter = [2];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '5':
                    $statinfilter = [1];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '6':
                    $statinfilter = [4];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                case '7':
                    $statinfilter = [11];
                    $model = $model->andWhere(['status' => $statinfilter]);
                    break;
                default:
                    $model = $model->andWhere(['!=', 'status', '0']);
                    break;
            }

        }
        $id = (int)Yii::$app->request->getQueryParam('id');
        if ($id) {
            $model = $model->andWhere(['partners_orders.id' => $id]);
        }
        $di = Yii::$app->request->getQueryParam('di');
        if ($di) {
            $model = $model->andWhere(['>', 'partners_orders.create_date', date('Y-m-d 00:00:00', strtotime($di))]);
        }
        $do = Yii::$app->request->getQueryParam('do');
        if ($do) {
            $model = $model->andWhere(['<=', 'partners_orders.create_date', date('Y-m-d 23:59:59', strtotime($do))]);
        }
        $orders = new yii\data\ActiveDataProvider([
            'query' => $model,
            'sort' => $sort,
            'pagination' => [
                'params' => array_merge($_GET, ['view' => 'myorder']),
                'defaultPageSize' => 20,
            ]

        ]);
        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu();
        return $this->render('lkspmyorder', ['cust' => $cust, 'orders' => $orders, 'sort_order' => $sort_order, 'menu' => $this->actionMenu()]);
    }
}

  