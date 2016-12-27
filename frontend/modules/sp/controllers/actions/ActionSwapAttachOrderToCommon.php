<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\CommonOrdersLinks;
use common\models\ReferralsUser;
use Yii;


trait ActionSwapAttachOrderToCommon
{
    public function actionSwapAttachOrderToCommon()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        $id_common_order = (int)Yii::$app->request->post('id_common_order');
        $id_order = (int)Yii::$app->request->post('id_order');

        $referral = Referrals::find()
            ->where(['user_id' => Yii::$app->user->getId()])
            ->asArray()
            ->one()
        ;

        if (!$referral) {
            return false;
        }

        $common_order = CommonOrders::find()
            ->where(['referral_id' => $referral])
            ->andWhere(['id' => $id_common_order, 'status'=>1])
            ->one()
        ;

        $order = PartnersOrders::find()
            ->where(['id' => $id_order, 'status'=>1])
            ->one()
        ;

        $referral_user = ReferralsUser::find()
            ->where([
                'user_id' => $order['user_id'],
                ReferralsUser::tableName() . '.referral_id' => $referral['id']
            ])
            ->one()
        ;

        if (!$common_order || !$order || !$referral_user) {
            \Yii::$app->getSession()->setFlash('error', 'Ошибка! Заказ не в статусе "Новый" или отсутствует');
            return false;
        }

        $exist_common_order_link = CommonOrdersLinks::find()
            ->where(['partner_orders_id' => $id_order])
            ->one();
        ;

        if (!$exist_common_order_link) {
            \Yii::$app->getSession()->setFlash('error', 'Ошибка! Заказ не прикреплен, чтобы его перемещать');
            return false;
        }

        $exist_common_order_link->common_orders_id = $common_order->id;

        if ($exist_common_order_link->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Удача! Заказ перемещен');
            return true;
        }

        return false;
    }
}