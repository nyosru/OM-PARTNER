<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\OrdersStatus;
use common\models\PartnersOrders;
use common\models\Orders;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;

trait ActionRequestorders
{
    public function actionRequestorders()
    {
        $model = new PartnersOrders();
        $provider = new ActiveDataProvider([
            'query' => $model->find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->orderBy('id DESC'),
            'pagination' => [
                'defaultPageSize' => 20
            ]

        ]);

        return $this->render('orders', ['orders' => $provider]);
    }
}