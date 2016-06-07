<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCart;

trait ActionViewCart
{
    public function actionViewcart()
    {
        $this->layout = 'lk';
        if (!\Yii::$app->user->isGuest) {
            $cart = PartnersCart::find()->where(['user_id' => \Yii::$app->user->getId()])->all();
            return $this->render('viewcart', ['cart' => $cart]);
        } else return $this->redirect('/');
    }
}