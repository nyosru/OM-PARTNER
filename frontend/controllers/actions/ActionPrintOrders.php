<?php
namespace frontend\controllers\actions;

use common\models\PartnersOrders;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;


trait ActionPrintOrders
{
    public function actionPrintorders()
    {

        $user = Yii::$app->getUser()->id;
        if (!$user) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->redirect('/site/login');;
        } else {
            if (($id = intval(Yii::$app->request->getQueryParam('id'))) === false) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['exception' => 'Что то не то'];
            } else {
                if (Yii::$app->user->can('admin')) {
                    $perm = ['id' => $id, 'partners_id' => Yii::$app->params['constantapp']['APP_ID']];
                } else {
                    $perm = ['id' => $id, 'user_id' => $user, 'partners_id' => Yii::$app->params['constantapp']['APP_ID']];
                }
                $ordersdata = PartnersOrders::find()->where($perm)->asArray()->one();
                $user = Yii::$app->user->getIdentity()->username;
                if (!$ordersdata) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['exception' => 'Заказ не найден'];
                } else {
                    $this->layout = 'print';
                    if ($ordersdata['orders_id'] > 0) {
                        $ordersdata['om'] = \common\models\Orders::find()->where(['orders_id' => $ordersdata['orders_id']])->asArray()->one();

                    }
                    return $this->render('print', ['data' => $ordersdata, 'user' => $user]);
                }
            }
        }

    }
}

?>