<?php
namespace frontend\controllers\actions;

use common\models\PartnersOrders;
use Yii;
use yii\data\ActiveDataProvider;


trait ActionPrintOrders
{
    public function actionPrintorders()
    {

        $user = Yii::$app->getUser()->id;
        if (!$user) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->redirect('/site/login');
        } else {
            if (($id = (integer)(Yii::$app->request->getQueryParam('id'))) === false) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['exception' => 'Что то не то'];
            } else {
                if (Yii::$app->user->can('admin')) {
                    $perm = ['partners_orders.id' => $id, 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']];
                } else {
                    $perm = ['partners_orders.id' => $id, 'partners_orders.user_id' => $user, 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']];
                }
                $ordersdata = PartnersOrders::find()->where($perm)->asArray()->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->one();
                if (!$ordersdata) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['exception' => 'Заказ не найден'];
                } else {
                    $this->layout = 'print';
                    return $this->render('print', ['data' => $ordersdata]);
                }
            }
        }

    }
}

?>