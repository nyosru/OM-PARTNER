<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCart;

trait ActionViewCart{
    public function actionViewcart(){
        $cart=PartnersCart::find()->where(['user_id'=>\Yii::$app->user->getId()])->all();
        return $this->render('viewcart',['cart'=>$cart]);
    }
}