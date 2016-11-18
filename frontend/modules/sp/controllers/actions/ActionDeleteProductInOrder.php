<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;


trait ActionDeleteProductInOrder
{
    public function actionDeleteProductInOrder()
    {
        $order_id = Yii::$app->request->post('order_id');
        $product_id = (integer)Yii::$app->request->post('product_id');
        $attr = (integer)Yii::$app->request->post('attr');

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
        return json_encode(false);
        }

        $un_order = unserialize($order->order);
        foreach ($un_order['products'] as $key => $product) {
            if ($product[0] == $product_id && $product[2] == $attr) {
                unset($un_order['products'][$key]);
            }
        }

        $un_order['products'] = array_values($un_order['products']);
        $order->order = serialize($un_order);

        if ($order->save()) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}