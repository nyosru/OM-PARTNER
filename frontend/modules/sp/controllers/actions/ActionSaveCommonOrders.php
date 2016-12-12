<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use common\traits\Orders\UpdateOrder;
use Yii;


trait ActionSaveCommonOrders
{

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
            $un_orders = [];
            $updateOrder = new UpdateOrder();
            foreach ($common_orders->partnerOrders as &$back_order) {
                foreach ($client_orders_list as $client_order) {

                    if (!isset($client_order['order']['products']) || count($client_order['order']['products']) == 0) {
                        continue;
                    }

                    if($client_order['id'] == $back_order->id) {
                        $back_order = $updateOrder->updateOrderWithClientProducts($back_order, $client_order['order']['products']);
                        $back_order->save();
                        $back_order->refresh();

                        $back_order->order = unserialize($back_order->order);
                        $un_orders[] = $back_order;
                    }

                }
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }

        return $un_orders;
    }
}