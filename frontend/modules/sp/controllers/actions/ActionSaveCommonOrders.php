<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;


trait ActionSaveCommonOrders
{

    /**
     * @param PartnersOrders $order
     * @param array $client_order_products
     * @return PartnersOrders
     */
    protected function updateOrder(PartnersOrders $order, $client_order_products)
    {

        if (!is_array($client_order_products)) {
            return $order;
        }

        $un_order = unserialize($order->order);
        foreach ($un_order['products'] as $key_back => &$product_back) {
            foreach ($client_order_products as $key_client => $product_client) {

                if ($product_back[0] == $product_client[0] && $product_back[2] == $product_client[2]) {
                    $un_order['products'][$key_back][4] = ((int)$product_client[4] >= 0) ? $product_client[4] : 0;
                }
            }
        }

        $products_after_deleting = array_filter($un_order['products'],
            function ($element) use ($client_order_products) {
                return in_array($element, $client_order_products);
            });

        $un_order['products'] = $products_after_deleting;

        $un_order['products'] = array_values($un_order['products']);

        $order->order = serialize($un_order);

        return $order;
    }

    public function actionSaveCommonOrders()
    {

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $common_order_id = Yii::$app->request->post('common_order_id');
        $client_orders_list = Yii::$app->request->post('orders_list');

        $referral = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $common_orders = CommonOrders::find()
            ->where(['referral_id' => $referral['id']])
            ->andWhere([CommonOrders::tableName() . '.id' => $common_order_id])
            ->joinWith('partnerOrders')
            ->one()
        ;

        $user = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referral['id']])
            ->limit(1)
            ->one()
        ;

        if (empty($user)) {
            return false;
        }

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            foreach ($common_orders->partnerOrders as &$back_order) {
                foreach ($client_orders_list as $client_order) {

                    if (!isset($client_order['order']['products'])) {
                        continue;
                    }

                    $back_order = $this->updateOrder($back_order, $client_order['order']['products']);
                    $back_order->save();
                }
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

        if ($common_orders->save()) {
            return $common_orders['partnerOrders'];
        } else {
            return false;
        }
    }
}