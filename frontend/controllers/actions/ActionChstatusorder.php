<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\Orders;
use common\models\Partners;
use common\models\PartnersOrders;

trait ActionChstatusorder
{
    public function actionChstatusorder()
    {
        $id = intval(Yii::$app->request->getQueryParam('id'));
        $key = Yii::$app->request->getQueryParam('key');
        $status = intval(Yii::$app->request->getQueryParam('status'));

        $order = new Orders();
        $orderdata = $order->find()->where(['orders_id' => $id])->asArray()->one();
        $data = $orderdata['customers_referer_url'];
        $data = json_decode($data);
        if ($key == $data->Key && isset($key) && $key != '') {

            $new_tok_order = Orders::findOne($id);
            $validkey = '';
            $char = 'QWERTYUPASDFGHJKLZXCVBNMqwertyuopasdfghjkzxcvbnm123456789';
            while (strlen($validkey) < 20) {
                $validkey .= $char[mt_rand(0, strlen($char))];
            }
            $new_tok_order->customers_referer_url = '{"Partner":"' . $data->Partner . '","User":"' . $data->User . '","Key":"' . $validkey . '","Site":"' . $data->Site . '"}';
            if ($new_tok_order->update()) {
                if ($status == 2) {
                    $model_order_partner = PartnersOrders::findOne(['orders_id' => $new_tok_order->id]);
                    $date_order = explode(' ', $model_order_partner->create_date);
                    $date_order = $date_order[0];
                    $partners_id = $model_order_partner->partners_id;
                    $partners = Partners::findOne($partners_id);
                    $site = $partners->domain;
                    $site_name = $partners->name;
                    $orders = new Orders();
                    $query = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $model_order_partner->orders_id . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->one();

                    $prodarr = [];
                    foreach ($query['products'] as $value) {
                        $prodarr[] = $value['products_id'];

                    }
                    $mail = explode('@@@', $new_tok_order->customers_email_address);
                    $mail = $mail[1];
                    Yii::$app->mailer->compose(['html' => 'order-ch-status'], ['model' => $model_order_partner, 'order' => $query, 'id' => $model_order_partner->id, 'site' => $site, 'site_name' => $site_name, 'date_order' => $date_order])
                        ->setFrom('support@' . $site)
                        ->setTo($mail)
                        ->setSubject('Заказ на сайте ' . $site)
                        ->send();
                }
                return '1';
            } else {
                return '0';
            }
        } else {
            return '0';
        }

    }
}