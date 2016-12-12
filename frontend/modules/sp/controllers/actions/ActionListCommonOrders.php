<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;


trait ActionListCommonOrders
{
    public function actionListCommonOrders()
    {
        $search = Yii::$app->request->post('search');

        $referral = Referrals::find()
            ->where(['user_id' => Yii::$app->user->getId()])
            ->asArray()
            ->one();
        $result = CommonOrders::find();

        $is_int_search = preg_match('/^\+?\d+$/', $search);
        if ($is_int_search) {
            $result = $result->andFilterWhere(['LIKE', 'id', $search . '%', false]);
        } else {
            $result = $result->andFilterWhere(['LIKE', 'header', $search . '%', false])
                ->orFilterWhere(['LIKE', 'description', $search . '%', false])
            ;
        }

        $result = $result->andWhere(['referral_id' => $referral])->orderBy('date_added DESC')->limit(5)->asArray()->all();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        return $result;
    }
}