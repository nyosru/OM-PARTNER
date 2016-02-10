<?php
namespace frontend\controllers\actions;

use Yii;
trait ActionCart{
    public function actionCart(){
        return $this->render('cart');
    }
}