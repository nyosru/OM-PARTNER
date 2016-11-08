<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use common\traits\Products\PreCheckProductsToOrder;
use yii;


trait ActionPreCheckProductToOrders
{
    use PreCheckProductsToOrder;
    public function actionPreCheckProductToOrders()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request_id = Yii::$app->request->post('product');
        $request_attr = Yii::$app->request->post('attr', FALSE);
        $request_count = Yii::$app->request->post('count', FALSE);
        $request_address = Yii::$app->request->post('address', FALSE);
        return $this->preCheckProductsToOrder($request_id, FALSE, FALSE, $request_address);;
    }


}