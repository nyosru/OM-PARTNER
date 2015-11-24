<?php
namespace frontend\modules\admin\controllers\actions;

use Yii;
use common\models\OrdersStatus;
use common\models\PartnersOrders;
use common\models\Orders;

trait ActionRequestorders{
    public function actionRequestorders()
    {
        $model = new PartnersOrders();
        $check = $this->id_partners();
        $page = intval(Yii::$app->request->getQueryParam('page'));
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $count = $model->find()->where(['partners_id' => $check])->count();
        if ($count <= $page * 10) {
            $page = $page - 1;
        }
        $query = $model->find()->where(['partners_id' => $check])->limit(1000)->offset($page * 10)->joinWith('userDescription')->asArray()->all();


        $orders_status_arr = OrdersStatus::find()->asArray()->all();


        foreach ($orders_status_arr as $valueos) {
            $orders_status[$valueos[0]] = $valueos[1];
        }
        $check = array();
        foreach ($query as $key => $value) {
            $query[$key]['order'] = unserialize($value['order']);
            $discount[$value['orders_id']] = $query[$key]['order']['discount'];
            $discounttotal[$value['orders_id']] = $query[$key]['order']['discounttotalprice'];
            unset($query[$key]['order']['ship']);
            unset($query[$key]['order']['discount']);
            unset($query[$key]['order']['discounttotalprice']);
            $query[$key]['userDescription'] = $query[$key]['userDescription']['email'];
            $query[$key]['delivery'] = unserialize($value['delivery']);
            $query[$key]['discounttotal'] = $discounttotal[$value['orders_id']];
            if ($value['orders_id'] != '' and $value['orders_id'] != NULL) {
                $check[] = $value['orders_id'];
            };

        }

        if (count($check) > 1) {
            $checkstr = implode(',', $check);
        } elseif (count($check) == 1) {
            $checkstr = $check[0];
        }
        if ($checkstr != '') {
            $orders = new Orders();
            // $query[ordersatus] = $checkstr;
            $ordersatusn = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $checkstr . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->all();
//            foreach ($ordersatusn as $valuesn) {
//                $valuesn = $orders_status;
//            }
            foreach ($query as $key => $value) {
                $query['ordersatus'][$ordersatusn[$key]['orders_id']] = $ordersatusn[$key];
                //   $query['ordersatus'][$ordersatusn[$key]['orders_status']] = $ordersatusn[$key];
                if (isset($discount[$ordersatusn[$key]['orders_id']])) {
                    $query['ordersatus'][$ordersatusn[$key]['orders_id']]['discount'] = $discount[$ordersatusn[$key]['orders_id']];
                }
            }
        }
        if ($count <= $page * 10) {
            $page = $page - 1;;
        } elseif ($page < 1) {
            $query['page'] = 0;

        } else {
            $query['page'] = $page;
        }
        return $query;
    }
}