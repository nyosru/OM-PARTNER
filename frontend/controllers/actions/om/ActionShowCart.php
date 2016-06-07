<?php
namespace frontend\controllers\actions\om;

//
use common\models\PartnersCart;
use yii;

trait ActionShowCart
{
    public function actionShowcart()
    {
        $get = Yii::$app->request->get('cart');
        if (!isset($get)) {
            return $this->render('showcart');
        } else {
            $get = (integer)$get;
            if (PartnersCart::find()->where(['id' => $get])->exists()) {
                $cart = PartnersCart::find()->where(['id' => $get])->one();
                if ($cart->sharing == 1) {
                    $success = 1;
                } else {
                    $success = 0;
                }
            } else {
                $cart = new PartnersCart();
                $success = 0;
            }
        }
        return $this->render('showcart', ['success' => $success, 'cart' => $cart]);
    }
}