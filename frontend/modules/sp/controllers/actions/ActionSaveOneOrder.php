<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
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

        $un_order = unserialize($order->order);
        foreach ($un_order['products'] as $key_back => &$product_back) {
            foreach ($client_order_products as $key_client => $product_client)
                if ($product_back[0] == $product_client[0] && $product_back[2] == $product_client[2]) {
                    $un_order['products'][$key_back][4] = ($product_client[4] >= 0) ? $product_client[4] : 0 ;
                }
        }

        $un_order['products'] = array_values($un_order['products']);
        $order->order = serialize($un_order);

        if ($order->save()) {
            return $un_order['products'];
        } else {
            return false;
        }
    }
}