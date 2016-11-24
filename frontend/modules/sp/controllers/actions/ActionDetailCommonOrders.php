<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;

trait ActionDetailCommonOrders
{
    public function actionDetailCommonOrders()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $id = (int)Yii::$app->request->post('id');

        $referral = Referrals::find()
            ->where(['user_id' => Yii::$app->user->getId()])
            ->asArray()
            ->one()
        ;

        $common_orders = CommonOrders::find()
            ->where(['referral_id' => $referral['id']])
            ->andWhere([CommonOrders::tableName() . '.id' => $id])
            ->joinWith('partnerOrders')
            ->asArray()
            ->one()
        ;

        foreach ($common_orders['partnerOrders'] as &$order) {

            $referral_user = ReferralsUser::find()
                ->where([
                    'user_id'                                   => $order['user_id'],
                    ReferralsUser::tableName() . '.referral_id' => $referral['id'],
                ])
                ->joinWith('user')
                ->joinWith('userinfo')
                ->asArray()
                ->one()
            ;

            $order['referral_user'] = $referral_user;
            $order['order'] = unserialize($order['order']);
        }

        return $common_orders;
    }
}