<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\CommonOrdersLinks;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;


trait ActionDeleteOrderFromCommonOrdersLinks
{
    public function actionDeleteOrderFromCommonOrdersLinks()
    {

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $order_id = Yii::$app->request->post('order_id');
        $common_id = Yii::$app->request->post('common_id');

        $referral = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $common_order = CommonOrders::find()
            ->where(['referral_id' => $referral, 'status'=>1])
            ->andWhere(['id' => $common_id])
            ->one()
        ;

        $order = PartnersOrders::find()
            ->where(['id' => $order_id, 'status'=>1])
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
            return false;
        }

        $exist_common_order_link = CommonOrdersLinks::find()
            ->where(['common_orders_id' => $common_id])
            ->andWhere(['partner_orders_id' => $order_id])
            ->one();
        ;

        if ($exist_common_order_link && $exist_common_order_link->delete()) {
            return true;
        } else {
            return false;
        }

    }
}