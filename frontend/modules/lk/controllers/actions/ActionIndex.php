<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\User;
use common\models\Orders;
use yii;


trait ActionIndex
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model = \common\models\Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->joinWith('ordersReports')->groupBy('orders.`orders_id` DESC');

        $sort = new yii\data\Sort([
            'attributes' => [
                'orders_id' => [
                    'asc' => ['orders_id' => SORT_ASC],
                    'desc' => ['orders_id' => SORT_DESC],
                    'default' => SORT_DESC,

                ],
            ],
        ]);

        $orders = new yii\data\ActiveDataProvider([
            'query' => $model,
            'sort' => $sort,
            'pagination' => [
                'params' => array_merge($_GET, ['view' => 'myorder']),
                'defaultPageSize' => 1,
            ]
        ]);
        $countpay = Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->andWhere(['orders.orders_status' => '2'])->count();
        $countcheck = Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->andWhere(['orders.orders_status' => '1'])->count();
        $countdelivery = Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->andWhere(['orders.orders_status' => '4'])->count();
        $countsborka = Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->andWhere(['orders.orders_status' => '11'])->count();
        $totalorder = Orders::find()->where('customers_id = :customer and orders_status = :status', [':customer' => $cust['customers']['customers_id'], ':status' => 5])->joinWith('products')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->count();

        $totalproducts = Orders::find()->where('customers_id = :customer and orders_status = :status', [':customer' => $cust['customers']['customers_id'], ':status' => 5])->select('SUM(`orders_products`.`products_quantity`) as totalprod, SUM(orders_products_sp.`products_quantity`) as total, SUM(`orders_products`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price, SUM(`orders_products_sp`.`products_quantity`*`orders_products`.`products_price`) as total_prod_price_sp')->joinWith('products')->joinWith('productsSP')->asArray()->all();


        $totalprice = (float)$totalproducts[0]['total_prod_price'] + (float)$totalproducts[0]['total_prod_price_sp'];
        $totalproducts = $totalproducts[0]['totalprod'] + $totalproducts[0]['total'];

        $totalcancel = \common\models\Orders::find()->where(['customers_id' => $cust['customers']['customers_id']])->joinWith('products')->joinWith('productsAttr')->joinWith('productsSP')->groupBy('orders.`orders_id` DESC')->andWhere(['orders.orders_status' => '6'])->count();

        return $this->render('lk', ['cust' => $cust, 'orders' => $orders, 'dataset' => ['countpay' => $countpay, 'countcheck' => $countcheck, 'countsborka' => $countsborka, 'countdelivery' => $countdelivery, 'totalorder' => $totalorder, 'totalproducts' => $totalproducts, 'totalprice' => $totalprice, 'totalcancel' => $totalcancel]]);
    }
}