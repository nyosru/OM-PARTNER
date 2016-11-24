<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\Customers;
use common\models\OrdersProducts;
use common\models\OrdersProductsPriten;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use frontend\widgets\ProductCard;
use yii;


trait ActionClaims
{
    public function actionClaims()
    {
        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $sort = new yii\data\Sort([
            'attributes' => [
                'orders_id' => [
                    'asc' => ['orders_id' => SORT_ASC],
                    'desc' => ['orders_id' => SORT_DESC],
                    'default' => SORT_DESC,

                ],
            ],
        ]);

        $ordersProducts = OrdersProducts::find()
            ->where(['priten'=>1,'customers_id' => $cust['customers']['customers_id']])
            ->joinWith('products')
            ->joinWith('order');

        $dataProvider = new yii\data\ActiveDataProvider([
            'query' => $ordersProducts,
            'sort' => $sort,
            'pagination' => [
                'defaultPageSize' => 20,
            ]
        ]);

        return $this->render('lkclaims',['dataProvider'=>$dataProvider,'model'=>$ordersProducts]);
    }
}