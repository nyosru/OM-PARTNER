<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use common\traits\Orders\UpdateOrder;
use Yii;


trait ActionSaveOneOrder
{
    public function actionSaveOneOrder()
    {

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $order_id = Yii::$app->request->post('order_id');
        $client_order_products = Yii::$app->request->post('products');

        /** @var PartnersOrders $order */
        $order = PartnersOrders::find()->where(['id' => $order_id])->one();

        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $user = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referal['id']])
            ->andWhere(['user_id' => $order->user_id])
            ->limit(1)
            ->one()
        ;

        if (empty($user)) {
            return false;
        }

        if (!is_array($client_order_products)) {
            return false;
        }

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {

            $updateOrder = new UpdateOrder();
            $order = $updateOrder->updateOrderWithClientProducts($order, $client_order_products);
            $order->save();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }

        $un_order = unserialize($order->order);
        return $un_order['products'];
    }
}