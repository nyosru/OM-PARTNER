<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\CommonOrdersLinks;
use common\models\ReferralsUser;
use Yii;


trait ActionAttachOrderToCommon
{
    public function actionAttachOrderToCommon()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        $id_common_order = (int)Yii::$app->request->post('id_common_order');
        $id_order = (int)Yii::$app->request->post('id_order');
        $comment = Yii::$app->request->post('comment');

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
            ->andWhere(['id' => $id_common_order,  'status'=>1])
            ->one()
        ;

        $order = PartnersOrders::find()
            ->where(['id' => $id_order,  'status'=>1])
            ->one()
        ;

        if($order->status != 1) {
            return false;
        }

        $referral_user = ReferralsUser::find()
            ->where([
                'user_id' => $order['user_id'],
                ReferralsUser::tableName() . '.referral_id' => $referral['id']
            ])
            ->one()
        ;

        if (!$common_order || !$order || !$referral_user) {
            return false;
        }

        $exist_common_order_link = CommonOrdersLinks::find()
            ->where(['partner_orders_id' => $id_order, 'status'=>1])
            ->one();
        ;

        if ($exist_common_order_link) {
            $exist_common_order_link = new CommonOrdersLinks();
            $exist_common_order_link->common_orders_id = $common_order->id;

            if ($exist_common_order_link->save()) {
                return true;
            }
        } else {
            $common_order_link = new CommonOrdersLinks();
            $common_order_link->common_orders_id = $common_order->id;
            $common_order_link->partner_orders_id = $order->id;
            $common_order_link->comments = (string)$comment ?: '';

            if ($common_order_link->save()) {
                return true;
            }
        }

        return false;
    }
}