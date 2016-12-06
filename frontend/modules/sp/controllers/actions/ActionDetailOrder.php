<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;
use yii\web\HttpException;


trait ActionDetailOrder
{
    public function actionDetailOrder()
    {
        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $id = (int)Yii::$app->request->post('id');

        $order = PartnersOrders::find()->where([PartnersOrders::tableName().'.id' => $id])->joinWith('commonOrder')->asArray()->one();

        $referraluser = ReferralsUser::find()
            ->where(['user_id' => $order['user_id'], ReferralsUser::tableName() . '.referral_id' => $referal['id']])
            ->joinWith('user')->joinWith('userinfo')->asArray()->one()
        ;

        $orders_count = PartnersOrders::find()->where(['user_id' => $referraluser['user_id']])->count();

        if ($id == true && $order == true && $referraluser == true) {

            if ($order['order'] != 'LinlToOM') {
                $order['order'] = unserialize($order['order']);
            }

            if ($order['delivery'] != 'LinlToOM') {
                $order['delivery'] = unserialize($order['delivery']);
            }

            $result = [
                'refus'        => $referraluser,
                'order'        => $order,
                'id'           => $id,
                'orders_count' => $orders_count,
            ];


            if (Yii::$app->request->isAjax) {
                $result = json_encode($result);
            }

            return $result;
        } else {
            return false;
        }

    }
}