<?php
namespace frontend\modules\lk\controllers\actions;

use common\models\PartnersCart;

trait ActionViewCart
{
    public function actionViewcart()
    {
        
        if (!\Yii::$app->user->isGuest) {
            $cart = PartnersCart::find()->where(['user_id' => \Yii::$app->user->getId()])->all();
            \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;
            return $this->render('viewcart', ['cart' => $cart]);
        } else return $this->redirect('/');
    }
}