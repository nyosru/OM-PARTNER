<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersOrders;
use yii\data\ActiveDataProvider;

trait ActionRequestorders
{
    public function actionRequestorders()
    {
        $model = new PartnersOrders();
        $provider = new ActiveDataProvider([
            'query' => $model->find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'user_id' => Yii::$app->getUser()->id])->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsAttr')->groupBy('id')->orderBy('id DESC'),
            'pagination' => [
                'defaultPageSize' => 20
            ]

        ]);
        $this->layout = 'lk';
        return $this->render('userorders', ['orders' => $provider]);
    }
}