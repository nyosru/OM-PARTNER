<?php
namespace frontend\controllers\actions;

use common\models\PartnersProducts;
use Yii;

trait ActionTakeOrder
{
    public function actionTakeorder()
    {
        $post = Yii::$app->request->post();
        $goods = [];
        foreach ($post['product'] as $key => $value) {
            $goods[] = $key;
        }
        $cost = PartnersProducts::find()->where(['products_id' => $goods])->asArray()->all();
        $prices = [];
        foreach ($cost as $key => $value) {
            $prices[$value['products_id']] = $value['products_price'];
        }
        return $this->render('takeorder');
    }
}