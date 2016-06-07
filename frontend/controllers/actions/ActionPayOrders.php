<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersOrders;

trait ActionPayOrders
{
    public function actionPayorders()
    {
        $user = Yii::$app->getUser()->id;
        if (!$user) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->redirect(BASEURL . '/login');
        } else {
            if (($id = (integer)(Yii::$app->request->getQueryParam('id'))) === false) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['exception' => 'Что то не то'];
            } else {
                $perm = ['partners_orders.id' => $id, 'partners_orders.user_id' => $user, 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']];
            }
            $ordersdata = PartnersOrders::find()->where($perm)->asArray()->joinWith('user')->joinWith('userDescription')
                ->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->one();
            if (!$ordersdata) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['exception' => 'Заказ не найден'];
            } else {
                $order = unserialize($ordersdata['order']);
                $markup = $order['discount']; // наценка партнера на заказ
                $discount = $order['discounttotalprice']; // скидка с заказа
                $overall = $ordersdata['oMOrdersProducts'];
                $sp_ids = []; // массив с oMOrdersProductsSP id=>количество
                foreach ($ordersdata['oMOrdersProductsSP'] as $item) {
                    $sp_ids[$item['orders_products_id']] = $item['products_quantity'];
                }
                $orderRev = []; // массив с возвратами id продукта=>количество
                foreach ($order as $item) {
                    $orderRev[$item['0']] = $item['8']['count'];
                }

                $totalCost = 0;
                foreach ($overall as $item) {
                    $price = $item['final_price'];
                    $firstQuant = $item['first_quant'];
                    $productsQuant = $item['products_quantity'];
                    $spQuantity = $sp_ids[$item['orders_products_id']];
                    $reverce = $orderRev[$item['products_id']];
                    $quantity = $productsQuant + $spQuantity - $reverce;
                    if ($firstQuant < $quantity) {
                        $quantity = $firstQuant;
                    }
                    $totalPrice = ($price * (1 + $markup / 100)) * (1 - $discount / 100);
                    $cost = round($totalPrice) * $quantity;
                    $totalCost += $cost;
                }
                return $this->render('payorders', ['totalcost' => $totalCost]);
                //return $this->render('payorders', ['data' => $ordersdata]);
            }
        }
    }

}